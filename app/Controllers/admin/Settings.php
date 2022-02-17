<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\SettingModel;

class Settings extends AbstractController
{

    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new SettingModel();
    }


    public function index()
    {
        $name = $this->model->get_by_key('site_name');
        $home_title = $this->model->get_by_key('home_title');
        $desc = $this->model->get_by_key('description');
        $notice = $this->model->get_by_key('notice');
        $keywords = $this->model->get_by_key('keywords');
        $bg_repeat = $this->model->get_by_key('bg_repeat', 1);
        $bg_color = $this->model->get_by_key('bg_color', '');
        $logo = $this->model->get_by_key('logo', '');
        $background = $this->model->get_by_key('background', '');

        $this->adminView('settings',
            array('site_name' => $name,
                'home_title' => $home_title,
                'notice' => $notice,
                'description' => $desc,
                'keywords' => $keywords,
                'bg_repeat' => $bg_repeat,
                'bg_color' => $bg_color,
                'logo' => $logo,
                'background' => $background), "网站配置");
    }


    public function maintain()
    {
        $name = $_POST['site_name'];
        $home_title = $_POST['home_title'];
        $desc = $_POST['description'];
        $keywords = $_POST['keywords'];
        $notice = $_POST['notice'];
        $logo = $this->_upload('logo');
        $background = $this->_upload('background');
        $bg_repeat = $_POST['bg_repeat'];
        $bg_color = $_POST['bg_color'];

        $this->model->change('site_name', $name);
        $this->model->change('home_title', $home_title);
        $this->model->change('description', $desc);
        $this->model->change('keywords', $keywords);
        $this->model->change('notice', $notice);
        if ($logo[0]) {
            $this->_delete('logo');
            $this->model->change('logo', $logo[1]);
        }
        if ($background[0]) {
            $this->_delete('background');
            $this->model->change('background', $background[1]);
        }
        $this->model->change('bg_repeat', $bg_repeat);
        $this->model->change('bg_color', $bg_color);

        $this->alertSuccess('更新网站设置成功');

        $this->redirect('admin/settings');
    }


    /**
     * 删除Logo
     */
    public function delete_logo()
    {
        $this->_delete('logo');
        $this->alertSuccess('删除LOGO成功');
        $this->redirect('admin/settings');
    }

    /**
     * 删除背景图
     */
    public function delete_bg()
    {
        $this->_delete('background');
        $this->alertSuccess('删除背景图成功');
        $this->redirect('admin/settings');
    }

    /**
     * 执行删除及跳转操作
     *
     * @param $key string 文件配置项
     */
    private function _delete($key)
    {
        $v = $this->model->get_by_key($key);
        del_upload_file($v);
        $this->model->delete_by_key($key);
    }


}