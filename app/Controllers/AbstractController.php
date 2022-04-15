<?php

namespace App\Controllers;

use App\Services\NavigatorService;
use App\Services\SettingService;
use CodeIgniter\HTTP\RedirectResponse;
use Config\App;
use Config\Custom;

class AbstractController extends BaseController
{

    private $settingService;
    private $navService;
    private $settings;
    private $session;

    private $theme;
    private $siteUrl;

    protected $uriUpload;
    protected $req;

    /**
     * constructor
     */
    public function __construct()
    {
        $bisonCfg = new Custom();
        $appConfig = new App();
        $this->settingService = new SettingService();
        $this->navService = new NavigatorService();
        $this->session = session();

        $this->settings = $this->settingService->findAll();
        $this->theme = $bisonCfg->theme;
        $this->siteUrl = $appConfig->baseURL;
        $this->req = service('request');

        $this->uriUpload = '/upload';
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
        if (!empty($alertMsg)) {
            $params['alert'] = $alertMsg;
            $this->session->remove('alert');
        }
        $params['siteUrl'] = $this->siteUrl;
        $params['uriAdmin'] = '/admin';
        $params['uriStatic'] = '/static';
        $params['uriUpload'] = $this->uriUpload;
        $params['title'] = $title;
        $params['siteName'] = $this->settings['siteName'];

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
        $params = empty($params) ? array() : $params;

        $params['uriStatic'] = '/static';
        $params['uriTheme'] = '/themes/' . $this->theme;
        $params['uriUpload'] = $this->uriUpload;
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
     * 获取POST请求中的全部内容
     * @return array 请求中的全部内容
     */
    protected function postParams(): array
    {
        $data = $this->req->getRawInput();
        if (empty($data)) {
            $data = $_POST;
        }
        return $data;
    }

    /**
     * 执行跳转
     *
     * @param $uri string 跳转目标路径
     * @return RedirectResponse 返回响应信息
     */
    protected function redirect(string $uri)
    {
        return redirect()->to($uri);
    }


}