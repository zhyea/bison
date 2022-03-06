<?php

namespace App\Controllers\admin;


use App\Services\SitemapService;
use CodeIgniter\HTTP\RedirectResponse;


class Sitemap extends AbstractAdmin
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
    public function gen(): RedirectResponse
    {
        $path = FCPATH . '/sitemap.xml';
        $this->sitemapService->genSitemap($path);
        $this->alertSuccess("生成网站地图成功");
        return $this->redirect('/admin/sitemap');
    }

}