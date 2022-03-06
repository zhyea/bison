<?php

namespace App\Controllers\admin;


use App\Services\ChapterService;
use App\Services\WorkService;
use CodeIgniter\HTTP\RedirectResponse;

class Chapter extends AbstractAdmin
{

    private $chapterService;

    private $workService;


    public function __construct()
    {
        parent::__construct();
        $this->chapterService = new ChapterService();
        $this->workService = new WorkService();
    }


    /**
     * 进入作品章节列表页
     * @param $workId int 作品ID
     */
    public function all(int $workId)
    {
        $work = $this->workService->get($workId);
        $chapters = $this->chapterService->volumes($workId);
        $title = (empty($work['name']) ? '' : $work['name'] . '-') . '章节列表';
        $this->adminView('chapters', array('work' => $work, 'vols' => $chapters), $title);
    }


    /**
     * 进入作品章节编辑页
     * @param $workId int 作品ID
     * @param $chapterId int 章节ID
     * @return RedirectResponse
     */
    public function edit(int $workId, int $chapterId = 0): RedirectResponse
    {
        if (empty($workId)) {
            return $this->redirect('admin/work/list');
        }
        $work = $this->workService->get($workId);
        if (empty($work)) {
            return $this->redirect('admin/work/list');
        }
        $chapter = array();
        if ($chapterId > 0) {
            $chapter = $this->chapterService->chapter($chapterId);
            $chapter = empty($chapter) ? array() : $chapter;
        }
        $chapter['work'] = $work;
        $title = (array_key_exists('name', $chapter) ? $chapter['name'] . '-' : '') . '编辑';
        $this->adminView('chapter-edit', $chapter, $title);
        die();
    }


    /**
     * 维护章节数据
     */
    public function maintain(): RedirectResponse
    {
        $data = $this->postParams();

        $workId = $data['work_id'];
        $id = $data['id'];

        $this->chapterService->maintain($data);
        $this->alertSuccess('保存章节信息成功');

        if (empty($id)) {
            return $this->redirect('admin/chapter/all/' . $workId);
        } else {
            return $this->redirect('admin/chapter/all/' . $workId . '/' . $id);
        }
    }


    /**
     * 上传作品
     */
    public function uploadWork(): RedirectResponse
    {
        $workId = $this->postParam('work_id');
        $r = $this->upload('myTxt');
        if ($r[0]) {
            $file = $r[1];
            $this->chapterService->upload($workId, $file);
            $this->alertSuccess("上传成功");
        }
        return $this->redirect('admin/chapter/all/' . $workId);
    }


    /**
     * 删除分卷及章节
     * @param $workId int 作品ID
     * @param $volId int 分卷ID
     * @return RedirectResponse
     */
    public function deleteVol(int $workId, int $volId): RedirectResponse
    {
        $this->chapterService->deleteVol($volId);
        $this->alertSuccess('删除成功');
        return $this->redirect('admin/chapter/all/' . $workId);
    }


    /**
     * 删除章节
     * @param $workId int 作品ID
     * @param $volId int 分卷ID
     * @param $chapterId int 章节ID
     * @return RedirectResponse
     */
    public function delete(int $workId, int $volId, int $chapterId): RedirectResponse
    {
        $this->chapterService->deleteChapter($volId, $chapterId);
        $this->alertSuccess('删除成功');
        return $this->redirect('admin/chapter/all/' . $workId);
    }


    /**
     * 删除作品下的全部分卷及章节信息
     * @param $workId int 作品ID
     * @return RedirectResponse
     */
    public function deleteAll(int $workId): RedirectResponse
    {
        $this->chapterService->deleteAll($workId);
        $this->alertSuccess('删除成功');
        return $this->redirect('admin/chapter/all/' . $workId);
    }


}