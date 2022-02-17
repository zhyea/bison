<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Service\ChapterService;
use App\Service\RemoteCodeService;
use App\Service\WorkService;

class RemoteController extends AbstractController
{

    private $rcService;
    private $workService;
    private $chapterService;

    public function __construct()
    {
        parent::__construct();
        $this->rcService = new RemoteCodeService();
        $this->workService = new WorkService();
        $this->chapterService = new ChapterService();
    }


    public function gen()
    {
        $this->rcService->set();
        $rc = $this->rcService->get_latest();
        $this->adminView('remote-code', $rc, '远程交互');
    }


    public function add_chapter()
    {
        $arr = $this->_post_array();

        $work_name = $arr['workName'];

        $work = $this->workService->get_by_name($work_name);
        if (empty($work)) {
            error_code(500, '作品不存在');
        }

        $work_id = $work['id'];
        $vol_name = array_value_of('volName', $arr);
        $chapter_name = $arr['chapterName'];
        $content = $arr['content'];

        $this->chapterService->add_chapter($work_id, $vol_name, $chapter_name, $content);

        echo 'success';
    }

}