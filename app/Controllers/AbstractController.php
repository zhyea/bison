<?php

namespace App\Controllers;

use App\Service\NavigatorService;
use App\Service\SettingService;

class AbstractController extends BaseController
{

    private $settingService;
    private $navService;
    private $siteCfg;

    /**
     * constructor.
     */
    public function __construct()
    {
        if (!defined('_ADMIN_URI_')) {
            define('_ADMIN_URI_', _VIEW_CONTEXT_ . '/admin');

        }
        if (!defined('_THEME_URI_')) {
            define('_THEME_URI_', _VIEW_CONTEXT_ . '/themes/' . _CFG_['theme']);
        }
        if (!defined('_UPLOAD_URI_')) {
            define('_UPLOAD_URI_', _VIEW_CONTEXT_ . '/upload');
        }
        $this->settingService = new SettingService();
        $this->siteCfg = $this->settingService->findAll();
        $this->navService = new NavigatorService();
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
        $params['uri_admin'] = _ADMIN_URI_;
        $params['uri_theme'] = _THEME_URI_;
        $params['uri_upload'] = _UPLOAD_URI_;
        $params['ctx'] = _APP_CONTEXT_ . '/';

        if (isset($_SESSION['alert'])) {
            $params['alert'] = $_SESSION['alert'];
            unset($_SESSION['alert']);
        }

        $params = $params + $this->siteCfg;

        $this->_render_view('admin', $page, $params, $title);
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
        $params['uri_theme'] = _THEME_URI_;
        $params['uri_upload'] = _UPLOAD_URI_;
        $params['ctx'] = _APP_CONTEXT_;
        $params['site_url'] = site_url();
        $params = $params + $this->siteCfg;

        $nav = $this->navService->navigator();
        $params['navigator'] = $nav['children'];

        $title = $title . '-' . $this->siteCfg['site_name'];
        $this->_render_view('themes' . DIRECTORY_SEPARATOR . _CFG_['theme'], $page, $params, $title);
    }


    /**
     * 渲染视图
     *
     * @param $dir string 主题目录
     * @param $_page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    private function _render_view($dir, $_page, $params, $title)
    {
        if (NULL == $params) {
            $params = array();
        }
        if (!array_key_exists('title', $params)) {
            $params['title'] = $title;
        }
        $_page = $dir . DIRECTORY_SEPARATOR . $_page;
        parent::render_view($_page, $params);
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
    protected function redirect($uri)
    {
        redirect_in_site($uri);
    }


    /**
     * 添加提示信息
     *
     * @param $msg string 提示内容
     * @param $type string 提示类型，对应bootstrap alert类
     */
    protected function addAlert(string $msg, string $type)
    {
        $_SESSION['alert'] = array('type' => $type, 'msg' => $msg);
    }


    /**
     * 提示成功信息
     * @param $msg string 提示信息
     */
    protected function alertSuccess(string $msg)
    {
        $this->addAlert($msg, 'success');
    }


    /**
     * 提示错误信息
     * @param $msg string 提示信息
     */
    protected function alertDanger(string $msg)
    {
        $this->addAlert($msg, 'danger');
    }


    /**
     * 展示json
     *
     * @param mixed $obj 对象
     */
    protected function render_json($obj)
    {
        echo json_encode($obj);
    }
}