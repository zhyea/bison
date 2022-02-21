<?php

namespace App\Controllers;

use App\Services\NavigatorService;
use App\Services\SettingService;
use Config\App;
use Config\Custom;
use function PHPUnit\Framework\isEmpty;

class AbstractController extends BaseController
{

    private $settingService;
    private $navService;
    private $settings;
    private $session;

    private $theme;
    private $siteUrl;

    /**
     * constructor.
     */
    public function __construct()
    {
        $customCfg = new Custom();
        $appConfig = new App();
        $this->settingService = new SettingService();
        $this->navService = new NavigatorService();
        $this->session = session();

        $this->settings = $this->settingService->findAll();
        $this->theme = $customCfg->theme;
        $this->siteUrl = $appConfig->baseURL;
    }


    /**
     * 展示后台页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    protected function adminView(string $page, array $params, string $title)
    {
        $alertMsg = session('alert');
        if (isEmpty($alertMsg)) {
            $params['alert'] = $alertMsg;
            $this->session->remove('alert');
        }
        $params['siteUrl'] = $this->siteUrl;
        $params['uriAdmin'] = '/admin';
        $params['title'] = $title;
        $params = $params + $this->settings;

        if ($page == 'login') {
            $this->renderView('admin', $page, $params);
        } else {
            $this->renderView('admin', 'common/header', $params);
            $this->renderView('admin', $page, $params);
            $this->renderView('admin', 'common/footer', $params);
        }
    }


    /**
     * 展示前端页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    protected function themeView(string $page, array $params, string $title)
    {
        $params['uriTheme'] = '/themes/' . $this->theme;
        $params['uriUpload'] = '/upload';
        $params['siteUrl'] = $this->siteUrl;

        $params = $params + $this->settings;

        $nav = $this->navService->navigator();
        $params['navigator'] = $nav['children'];

        $title = $title . '-' . $this->settings['siteName'];
        if (!array_key_exists('title', $params)) {
            $params['title'] = $title;
        }
        $dir = 'themes' . DIRECTORY_SEPARATOR . $this->theme;

        $this->renderView($dir, 'header', $params);
        $this->renderView($dir, $page, $params);
        $this->renderView($dir, 'footer', $params);
    }


    /**
     * 渲染视图
     *
     * @param $dir string 主题目录
     * @param $page string 页面地址
     * @param $params array 页面变量
     */
    private function renderView(string $dir, string $page, array $params)
    {
        $page = $dir . DIRECTORY_SEPARATOR . $page;
        echo view($page, $params);
        //exit();
    }


    /**
     * 上传文件，文件将按日期保存，并提供随机ID作为名称
     *
     * @param $name string 文件表单名
     * @return array 文件是否上传成功 / 失败原因 / 保存位置
     */
    protected function _upload(string $name)
    {
        $save_name = uniqid();
        $sub_path = date('Y/m/d');
        return parent::_do_upload($name, $save_name, $sub_path);
    }


    /**
     * 执行跳转
     *
     * @param $uri string 跳转目标路径
     */
    /*protected function redirect(string $uri)
    {
        redirect($uri);
    }*/



}