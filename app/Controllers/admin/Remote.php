<?php

namespace App\Controllers\admin;


use App\Services\ChapterService;
use App\Services\RemoteCodeService;
use App\Services\WorkService;

class Remote extends AbstractAdmin
{

    private $rcService;
    private $workService;
    private $chapterService;

    public function __construct()
    {
        helper('url');
        parent::__construct();
        $this->rcService = new RemoteCodeService();
        $this->workService = new WorkService();
        $this->chapterService = new ChapterService();
    }


    /**
     * 打开远程代码页
     */
    public function gen()
    {
        $user = $this->sessionOf('user');
        $this->rcService->set($user);
        $rc = $this->rcService->getLatest($user);
        $this->adminView('remote-code', $rc, '远程交互');
    }


    /**
     * 新增章节信息
     */
    public function addChapter()
    {
        $arr = $this->postBody();

        $workName = $arr['workName'];
        $work = $this->workService->getByName($workName);
        if (empty($work)) {
            error_code(500, '作品不存在');
        }

        $workId = $work['id'];
        $volName = array_value_of('volName', $arr);
        $chapterName = $arr['chapterName'];
        $content = $arr['content'];

        $this->chapterService->addChapter($workId, $volName, $chapterName, $content);

        echo 'success';
    }

}