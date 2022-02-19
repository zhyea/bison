<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Services\SitemapService;


class Sitemap extends AbstractController
{


    private $sitemapService;

    public function __construct()
    {
        parent::__construct();
        $this->sitemapService = new SitemapService();
    }

    /**
     * 进入缓存管理页
     */
    public function index()
    {
        $this->adminView('sitemap', array(), '网站地图');
    }


    /**
     * 清理缓存
     */
    public function gen()
    {
        $this->sitemapService->genSitemap();
        $this->alertSuccess("生成网站地图成功");
        $this->redirect('/admin/sitemap');
    }

}