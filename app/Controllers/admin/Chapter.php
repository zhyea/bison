<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Service\ChapterService;
use App\Service\WorkService;

class Chapter extends AbstractController
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
     * @param $work_id int 作品ID
     */
    public function all($work_id)
    {
        $work = $this->workService->get($work_id);
        $chapters = $this->chapterService->volumes($work_id);
        $title = (empty($work['name']) ? '' : $work['name'] . '-') . '章节列表';
        $this->adminView('chapters', array('work' => $work, 'vols' => $chapters), $title);
    }


    /**
     * 进入作品章节编辑页
     * @param $work_id int 作品ID
     * @param $chapter_id int 章节ID
     */
    public function edit($work_id, $chapter_id = 0)
    {
        if (empty($work_id)) {
            $this->redirect('admin/work/list');
        }
        $work = $this->workService->get($work_id);
        if (empty($work)) {
            $this->redirect('admin/work/list');
        }
        $chapter = array();
        if ($chapter_id > 0) {
            $chapter = $this->chapterService->chapter($chapter_id);
            $chapter = empty($chapter) ? array() : $chapter;
        }
        $chapter['work'] = $work;
        $title = (array_key_exists('name', $chapter) ? $chapter['name'] . '-' : '') . '编辑';
        $this->adminView('chapter-edit', $chapter, $title);
    }


    /**
     * 维护章节数据
     */
    public function maintain()
    {
        $data = $this->_post();

        $work_id = $data['work_id'];
        $id = $data['id'];

        $this->chapterService->maintain($data);
        $this->alertSuccess('保存章节信息成功');

        if (empty($id)) {
            $this->redirect('admin/chapter/all/' . $work_id);
        } else {
            $this->redirect('admin/chapter/all/' . $work_id . '/' . $id);
        }
    }


    /**
     * 上传作品
     */
    public function upload()
    {
        $work_id = $_POST['work_id'];
        $r = $this->_upload('myTxt');
        if ($r[0]) {
            $file = $r[1];
            try {
                $this->chapterService->upload($work_id, $file);
                $this->alertSuccess("上传成功");
            } catch (Exception $e) {
                $this->alertDanger('上传异常' . $e->getMessage());
            }
        }
        $this->redirect('admin/chapter/all/' . $work_id);
    }


    /**
     * 删除分卷及章节
     * @param $work_id int 作品ID
     * @param $vol_id int 分卷ID
     */
    public function delete_vol($work_id, $vol_id)
    {
        $this->chapterService->delete_vol($vol_id);
        $this->alertSuccess('删除成功');
        $this->redirect('admin/chapter/all/' . $work_id);
    }


    /**
     * 删除章节
     * @param $work_id int 作品ID
     * @param $vol_id int 分卷ID
     * @param $chapter_id int 章节ID
     */
    public function delete($work_id, $vol_id, $chapter_id)
    {
        $this->chapterService->delete_chapter($vol_id, $chapter_id);
        $this->alertSuccess('删除成功');
        $this->redirect('admin/chapter/all/' . $work_id);
    }


    /**
     * 删除作品下的全部分卷及章节信息
     * @param $work_id int 作品ID
     */
    public function delete_all($work_id)
    {
        $this->chapterService->delete_all($work_id);
        $this->alertSuccess('删除成功');
        $this->redirect('admin/chapter/all/' . $work_id);
    }


}