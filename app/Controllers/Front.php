<?php

namespace App\Controllers;

use App\Services\AuthorService;
use App\Services\ChapterService;
use App\Services\CommentService;
use App\Services\SettingService;
use App\Services\WorkService;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Custom;

class Front extends AbstractController
{


    private $workService;
    private $chapterService;
    private $authorService;
    private $settingService;
    private $pageLen;
    private $commentService;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $customCfg = new Custom();
        $this->pageLen = $customCfg->pageLength;
        $this->workService = new WorkService();
        $this->chapterService = new ChapterService();
        $this->authorService = new AuthorService();
        $this->settingService = new SettingService();
        $this->commentService = new CommentService();
    }


    /**
     * 进入首页
     */
    public function index()
    {
        $homeTitle = $this->settingService->homeTitle();
        $homeTitle = empty($homeTitle) ? "首页" : $homeTitle;
        $data = $this->workService->homeWorks();
        $this->themeView('index', $data, $homeTitle);
    }


    /**
     * 进入分类页
     * @param $alias string 分类别名
     * @param $page int 页码数
     * @return RedirectResponse
     */
    public function category(string $alias, int $page = 1): RedirectResponse
    {
        $data = $this->workService->findWithCat($alias, $page, $this->pageLen);
        if (empty($data)) {
            return $this->goHome();
        }
        $this->themeView('category', $data, $data['title']);
        die();
    }


    /**
     * 进入专题页
     * @param $alias string 专题别名
     * @param $page int 页码数
     * @return RedirectResponse
     */
    public function feature(string $alias, int $page = 1): RedirectResponse
    {
        $data = $this->workService->findWithFeature($alias, $page, $this->pageLen);
        if (empty($data)) {
            return $this->goHome();
        }
        $this->themeView('feature', $data, $data['title']);
        die();
    }


    /**
     * 进入作家专题页
     * @param $id int 作家id
     * @param $page int 页码数
     * @return RedirectResponse
     */
    public function author(int $id, int $page = 1): RedirectResponse
    {
        $data = $this->workService->findWithAuthor($id, $page, $this->pageLen);
        if (empty($data)) {
            return $this->goHome();
        }
        $this->themeView('author', $data, $data['title']);
        die();
    }


    /**
     * 获取作品信息
     * @param $workId int 作品ID
     * @return RedirectResponse
     */
    public function work(int $workId): RedirectResponse
    {
        $work = $this->workService->getWork($workId);
        if (empty($work)) {
            return $this->goHome();
        }
        $this->workService->addSn($workId);
        $vols = $this->chapterService->volumes($workId);
        $relates = $this->workService->relate($workId, $work['author_id']);
        $comments = $this->commentService->findWorkComments($workId);
        $keywords = $work['name'] . ',' . $work['author'] . ',' . $work['cat'];

        $this->themeView('work', array('w' => $work,
            'vols' => $vols, 'relates' => $relates,
            'keywords' => $keywords, 'description' => $work['brief'],
            'comments' => $comments, 'workId' => $workId, 'chapterId' => 0),
            $work['name']);
        die();
    }


    /**
     * 获取章节信息
     * @param $chapterId int 章节ID
     * @return RedirectResponse
     */
    public function chapter(int $chapterId): RedirectResponse
    {
        $chapter = $this->chapterService->getChapter($chapterId);
        if (empty($chapter)) {
            return $this->goHome();
        }
        $comments = $this->commentService->findChapterComments($chapter['workId'], $chapterId);
        $chapter['comments'] = $comments;
        $this->themeView('chapter', $chapter, $chapter['title']);
        die();
    }


    /**
     * 获取作家集合页
     */
    public function authors()
    {
        $authors = $this->authorService->all();
        $this->themeView('authors', array('all' => $authors, 'description' => '作家信息集合'), '作家');
    }


    /**
     * 添加评论信息
     */
    public function addComment()
    {
        $ip = $this->request->getIPAddress();
        // TODO 添加评论前需要限制评论数量
    }


    /**
     * 回到首页
     * @return RedirectResponse
     */
    private function goHome(): RedirectResponse
    {
        return $this->redirect('');
    }


}