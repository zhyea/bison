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
        $name = $this->model->getByKey('siteName');
        $homeTitle = $this->model->getByKey('homeTitle');
        $desc = $this->model->getByKey('description');
        $notice = $this->model->getByKey('notice');
        $keywords = $this->model->getByKey('keywords');
        $bgRepeat = $this->model->getByKey('bgRepeat', 1);
        $bgColor = $this->model->getByKey('bgColor', '');
        $logo = $this->model->getByKey('logo', '');
        $background = $this->model->getByKey('background', '');

        $this->adminView('settings',
            array('siteName' => $name,
                'homeTitle' => $homeTitle,
                'notice' => $notice,
                'description' => $desc,
                'keywords' => $keywords,
                'bgRepeat' => $bgRepeat,
                'bgColor' => $bgColor,
                'logo' => $logo,
                'background' => $background), "网站配置");
    }


    public function maintain()
    {
        $name = $_POST['siteName'];
        $home_title = $_POST['homeTitle'];
        $desc = $_POST['description'];
        $keywords = $_POST['keywords'];
        $notice = $_POST['notice'];
        $logo = $this->_upload('logo');
        $background = $this->_upload('background');
        $bgRepeat = $_POST['bgRepeat'];
        $bgColor = $_POST['bgColor'];

        $this->model->change('siteName', $name);
        $this->model->change('homeTitle', $home_title);
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
        $this->model->change('bgRepeat', $bgRepeat);
        $this->model->change('bgColor', $bgColor);

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