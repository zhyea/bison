<?php


namespace App\Services;


use App\Models\ChapterModel;
use App\Models\VolumeModel;
use App\Models\WorkModel;

class ChapterService extends BaseService
{


    private $workModel;
    private $volumeModel;
    private $chapterModel;

    /**
     * ChapterService constructor.
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->volumeModel = new VolumeModel();
        $this->chapterModel = new ChapterModel();
    }


    /**
     * 获取作品章节信息
     * @param int $workId 作品ID
     * @return array 作品章节信息
     */
    public function volumes(int $workId): array
    {
        $chapters = $this->chapterModel->findByWorkId($workId);
        if (empty($chapters)) {
            return array();
        }
        $volumes = $this->volumeModel->findByWorkId($workId);
        if (empty($volumes)) {
            array_push($volumes, array('id' => 0, 'name' => '正文'));
        }
        $map = array();
        foreach ($volumes as $v) {
            $map[$v['id']] = $v;
        }

        foreach ($chapters as $c) {
            $volId = $c['volume_id'];
            if (empty($volId)) {
                $volId = 0;
            }
            if (!array_key_exists($volId, $map)) {
                $map[$volId] = array('id' => $volId, 'name' => '待定');
            }
            $vol = &$map[$volId];
            if (!array_key_exists('chapters', $vol)) {
                $vol['chapters'] = array();
            }
            array_push($vol['chapters'], $c);
        }

        ksort($map);

        return array_values($map);
    }


    /**
     * 章节信息
     * @param int $chapterId 章节ID
     * @return array 章节信息
     */
    public function chapter(int $chapterId): array
    {
        $chapter = $this->chapterModel->getById($chapterId);
        if (empty($chapter)) {
            return array();
        }
        $vol = $this->volumeModel->getById($chapter['volume_id']);
        $chapter['volume'] = empty($vol) ? '' : $vol['name'];
        return $chapter;
    }


    /**
     * 获取章节信息
     * @param int $chapterId 章节信息
     * @return array 章节信息
     */
    public function getChapter(int $chapterId): array
    {
        $chapter = $this->chapter($chapterId);
        if (empty($chapter)) {
            return array();
        }
        $workId = $chapter['work_id'];
        $work = $this->workModel->getWork($workId);

        $last = $this->chapterModel->getLast($workId, $chapterId);
        $last = empty($last) ? null : $last['id'];
        $next = $this->chapterModel->getNext($workId, $chapterId);
        $next = empty($next) ? null : $next['id'];

        $keywords = $work['name'] . ',' . $chapter['name'] . ',' . $work['author'];

        $brief = empty($chapter['content']) ? '' : (strlen($chapter['content']) > 550 ? substr($chapter['content'], 0, 512) : $chapter['content']);
        $brief = strip_tags($brief);

        $title = $work['name'] . '-' . $chapter['name'];
        return array('w' => $work, 'chp' => $chapter,
            'last' => $last, 'next' => $next,
            'title' => $title,
            'keywords' => $keywords, 'description' => $brief, 'workId' => $workId);
    }


    /**
     * 获取分卷ID
     * @param int $workId 作品ID
     * @param string $volName 分卷名称
     * @return int 分卷ID
     */
    public function getVolumeId(int $workId, string $volName): int
    {
        $vol = $this->volumeModel->getByWorkAndName($workId, $volName);
        if (!empty($vol)) {
            if ($volName != $vol['name']) {
                $vol['name'] = $volName;
                $this->volumeModel->updateById($vol);
            }
            return $vol['id'];
        }
        $vol = array('work_id' => $workId, 'name' => $volName);
        $this->volumeModel->insertSilent($vol);
        $vol = $this->volumeModel->getByWorkAndName($workId, $volName);
        return $vol['id'];
    }


    /**
     * 维护章节信息
     * @param array $data 章节信息
     */
    public function maintain(array $data)
    {
        $work_id = $data['work_id'];
        $vol_id = empty($data['volume_id']) ? 0 : $data['volume_id'];
        if (!empty($data['new_volume'])) {
            $vol_id = $this->getVolumeId($work_id, $data['new_volume']);
            $data['volume_id'] = $vol_id;
        }
        if (0 == $vol_id && !empty($data['volume'])) {
            $vol_id = $this->getVolumeId($work_id, $data['volume']);
            $data['volume_id'] = $vol_id;
        } else if (0 != $vol_id && empty($data['new_volume']) && !empty($data['volume'])) {
            $vol = $this->volumeModel->getById($vol_id);
            if ($vol['name'] != $data['volume']) {
                $vol['name'] = $data['volume'];
                $this->volumeModel->updateById($vol);
            }
        }

        $data = array_key_rm('volume', $data);
        $data = array_key_rm('new_volume', $data);
        $this->chapterModel->insertOrUpdate($data);
    }


    /**
     * 新增章节
     * @param int $workId 作品ID
     * @param string $volName 分卷名称
     * @param string $chapterName 章节名称
     * @param string $content 章节内容
     */
    public function addChapter(int $workId, string $volName, string $chapterName, string $content)
    {
        $vol = array();
        if (empty($volName) || $volName == $chapterName) {
            $vol = $this->volumeModel->getLatestByWorkId($workId);
            if (empty($vol)) {
                $volName = '正文';
            }
        }

        if (empty($chapterName)) {
            $chapterName = '引子';
            $volName = '引子';
        }
        if (empty($vol)) {
            $vol = $this->volumeModel->getByWorkAndName($workId, $volName);
        }
        if (empty($vol)) {
            $this->volumeModel->add($workId, $volName);
            $vol = $this->volumeModel->getByWorkAndName($workId, $volName);
        }
        $this->chapterModel->add($workId, $vol['id'], $chapterName, $content);

    }


    /**
     * 上传作品
     * @param int $workId 作品ID
     * @param string $file 上传的文件地址
     */
    public function upload(int $workId, string $file)
    {
        $pattern = '/^[第卷]?[\s]{0,9}[\d〇零一二三四五六七八九十百千万上中下０１２３４５６７８９ⅠⅡⅢⅣⅤⅥⅦⅧⅨⅩⅪⅫ　\s]{1,6}[\s]{0,9}[、，．\.]?[章回节卷部篇讲集分]{0,2}([\s]{1,9}.{0,32})?$/iu';
        $arr = array("楔子", "引子", "引言", "前言", "序章", "序言", "序曲", "尾声", "终章", "后记", "序", "序幕", "跋", "附", "附言", "简介");
        $file_path = FCPATH . '/upload/' . $file;
        $f = file($file_path);
        $chapter_name = '';
        $vol_name = '';
        $content = '';
        foreach ($f as $num => $line) {
            $line = mb_trim($line);
            $line = str_replace('　', ' ', $line);

            if (empty($line)) {
                continue;
            }
            if (in_array($line, $arr) || preg_match($pattern, $line)) {
                if (empty($content) && !empty($chapter_name)) {
                    //处理存在两级章节的情形
                    $chapter_name = $line;
                } elseif (!empty($content)) {
                    $this->addChapter($workId, $vol_name, $chapter_name, $content);
                    $content = '';
                    $vol_name = $line;
                    $chapter_name = $line;
                } else {
                    $vol_name = $line;
                    $chapter_name = $line;
                }
            } else {
                $content = $content . '<p>' . $line . '</p>';
            }
        }
        $this->addChapter($workId, $vol_name, $chapter_name, $content);
        helper('io');
        del_file($file_path);
    }


    /**
     * 删除分卷信息
     * @param int $volId 分卷ID
     */
    public function deleteVol(int $volId)
    {
        $this->volumeModel->deleteById($volId);
        $this->chapterModel->deleteByVol($volId);
    }


    /**
     * 删除章节
     * @param int $volId 分卷ID
     * @param int $chapterId 章节ID
     */
    public function deleteChapter(int $volId, int $chapterId)
    {
        $this->chapterModel->deleteById($chapterId);
        $count = $this->chapterModel->countByVol($volId);
        if ($count <= 0) {
            $this->volumeModel->deleteById($volId);
        }
    }


    /**
     * 删除作品下的全部分卷及章节信息
     * @param int $workId 作品ID
     */
    public function deleteAll(int $workId)
    {
        $this->volumeModel->deleteByWork($workId);
        $this->chapterModel->deleteByWork($workId);
    }

}