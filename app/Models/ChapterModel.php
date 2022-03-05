<?php


namespace App\Models;


use CodeIgniter\Database\BaseResult;
use ReflectionException;

class ChapterModel extends BaseModel
{


    /**
     * 根据workId执行查询章节信息
     * @param int $workId 作品ID
     * @return array 章节信息
     */
    public function findByWorkId(int $workId): array
    {
        if ($workId <= 0) {
            return array();
        }
        return $this->asArray()
            ->where('work_id', $workId)
            ->orderBy('id')
            ->findAll();
    }


    /**
     * 新增章节信息
     * @param int $workId 作品ID
     * @param int $volId 分卷ID
     * @param string $chapterName 章节名称
     * @param string $content 章节内容
     * @return BaseResult|false|int|object|string 操作结果
     */
    public function add(int $workId,
                        int $volId,
                        string $chapterName,
                        string $content)
    {
        try {
            return $this->insert(array('work_id' => $workId,
                'volume_id' => $volId,
                'name' => $chapterName,
                'content' => $content));
        } catch (ReflectionException $e) {
            return false;
        }
    }


    /**
     * 删除分卷下的全部章节
     * @param int $volId 分卷ID
     * @return bool 是否删除成功
     */
    public function deleteByVol(int $volId): bool
    {
        return $this->delete(array('volume_id' => $volId));
    }


    /**
     * 根据分卷统计章节
     * @param int $volId 章节ID
     * @return int 统计结果
     */
    public function countByVol(int $volId): int
    {
        return $this->countBy(array('volume_id' => $volId));
    }


    /**
     * 查询章节信息
     * @param int $id 章节ID
     * @return array 章节信息
     */
    public function getChapter(int $id): array
    {
        return $this->asArray()
            ->select(array('chapter.*', 'volume.name as volume_name'))
            ->join('volume', 'chapter.volume_id=volume.id', 'LEFT')
            ->where('chapter.id', $id)
            ->first();
    }


    /**
     * 根据作品信息删除全部章节
     * @param int $workId 作品ID
     * @return bool 是否删除成功
     */
    public function deleteByWork(int $workId): bool
    {
        return $this->where('work_id', $workId)->delete();
    }


    /**
     * 获取上一节
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @return array|object|null 章节信息
     */
    public function getLast(int $workId, int $chapterId)
    {
        return $this->asArray()
            ->select('id')
            ->where('work_id', $workId)
            ->where('id<' . $chapterId)
            ->orderBy('id', 'desc')
            ->first();
    }


    /**
     * 获取下一节
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @return array|object|null 章节信息
     */
    public function getNext(int $workId, int $chapterId)
    {
        return $this->asArray()
            ->select('id')
            ->where('work_id', $workId)
            ->where('id<' . $chapterId)
            ->orderBy('id', 'desc')
            ->first();
    }

}