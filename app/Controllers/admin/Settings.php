<?php

namespace App\Controllers\admin;


use App\Models\SettingModel;
use CodeIgniter\HTTP\RedirectResponse;


class Settings extends AbstractAdmin
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


    /**
     * 进入系统配置页
     */
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


    /**
     * 更新配置信息
     * @return RedirectResponse
     */
    public function maintain(): RedirectResponse
    {
        $name = $this->postParam('siteName');
        $homeTitle = $this->postParam('homeTitle');
        $desc = $this->postParam('description');
        $keywords = $this->postParam('keywords');
        $notice = $this->postParam('notice');
        $logo = $this->upload('logo');
        $background = $this->upload('background');
        $bgRepeat = $this->postParam('bgRepeat');
        $bgColor = $this->postParam('bgColor');

        $this->model->change('siteName', $name);
        $this->model->change('homeTitle', $homeTitle);
        $this->model->change('description', $desc);
        $this->model->change('keywords', $keywords);
        $this->model->change('notice', $notice);
        if ($logo[0]) {
            $this->cleanFile('logo');
            $this->model->change('logo', $logo[1]);
        }
        if ($background[0]) {
            $this->cleanFile('background');
            $this->model->change('background', $background[1]);
        }
        $this->model->change('bgRepeat', $bgRepeat);
        $this->model->change('bgColor', $bgColor);

        $this->alertSuccess('更新网站设置成功');

        return $this->redirect('admin/settings');
    }


    /**
     * 删除Logo
     */
    public function deleteLogo(): RedirectResponse
    {
        $this->cleanFile('logo');
        $this->alertSuccess('删除LOGO成功');
        return $this->redirect('admin/settings');
    }

    /**
     * 删除背景图
     */
    public function deleteBg(): RedirectResponse
    {
        $this->cleanFile('background');
        $this->alertSuccess('删除背景图成功');
        return $this->redirect('admin/settings');
    }

    /**
     * 删除文件
     *
     * @param $key string 文件配置项
     */
    private function cleanFile(string $key)
    {
        $v = $this->model->getByKey($key);
        if (!empty($v)) {
            $this->deleteUploadedFile($v);
        }
        $this->model->deleteByKey($key);
    }


}