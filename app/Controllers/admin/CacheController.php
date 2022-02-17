<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;

class CacheController extends AbstractController
{
    /**
     * 进入缓存管理页
     */
    public function index()
    {
        $this->adminView('cache-settings', array(), '缓存设置');
    }


    /**
     * 清理缓存
     */
    public function clean()
    {
        $this->cacheService->clean();
        $this->alertSuccess("缓存清理成功");
        $this->redirect('/admin/cache');
    }

}