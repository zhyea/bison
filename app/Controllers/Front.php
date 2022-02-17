<?php

namespace App\Controllers;

use App\Service\AuthorService;
use App\Service\ChapterService;
use App\Service\SettingService;
use App\Service\WorkService;

class Front extends AbstractController
{


    private $workService;
    private $chapterService;
    private $authorService;
    private $settingService;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
        $this->chapterService = new ChapterService();
        $this->authorService = new AuthorService();
        $this->settingService = new SettingService();
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
     */
    public function category(string $alias, $page = 1)
    {
        $data = $this->workService->findWithCat($alias, $page);
        if (empty($data)) {
            error_404_page();
        }
        $this->themeView('category', $data, $data['_title']);
    }


    /**
     * 进入专题页
     * @param $alias string 专题别名
     * @param $page int 页码数
     */
    public function feature(string $alias, $page = 1)
    {
        $data = $this->workService->findWithFeature($alias, $page);
        if (empty($data)) {
            error_404_page();
        }
        $this->themeView('feature', $data, $data['_title']);
    }


    /**
     * 进入作家专题页
     * @param $id int 作家id
     * @param $page int 页码数
     */
    public function author(int $id, $page = 1)
    {
        $data = $this->workService->findWithAuthor($id, $page);
        if (empty($data)) {
            error_404_page();
        }
        $this->themeView('author', $data, $data['_title']);
    }


    /**
     * 获取作品信息
     * @param $workId int 作品ID
     */
    public function work(int $workId)
    {
        $work = $this->workService->getWork($workId);
        if (empty($work)) {
            error_404_page();
        }
        $this->workService->addSn($workId);
        $vols = $this->chapterService->volumes($workId);
        $relates = $this->workService->relate($workId, $work['author_id']);
        $keywords = $work['name'] . ',' . $work['author'] . ',' . $work['cat'];
        $this->themeView('work', array('w' => $work,
            'vols' => $vols, 'relates' => $relates,
            'keywords' => $keywords,
            'description' => $work['brief']), $work['name']);
    }


    /**
     * 获取章节信息
     * @param $chapterId int 章节ID
     */
    public function chapter(int $chapterId)
    {
        $chapter = $this->chapterService->getChapter($chapterId);
        if (empty($chapter)) {
            error_404_page();
        }
        $this->themeView('chapter', $chapter, $chapter['_title']);
    }


    /**
     * 获取作家集合页
     */
    public function authors()
    {
        $authors = $this->authorService->all();
        $this->themeView('authors', array('all' => $authors, 'description' => '作家信息集合'), '作家');
    }


}