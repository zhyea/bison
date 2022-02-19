<?php


namespace App\Services;


use App\Models\ScriptModel;
use App\Models\SettingModel;

class SettingService extends BaseService
{

    private $settingModel;
    private $scriptModel;

    /**
     * SettingService constructor.
     */
    public function __construct()
    {
        $this->scriptModel = new ScriptModel();
        $this->settingModel = new SettingModel();
    }


    /**
     * 获取全部配置信息
     * @return array 全部配置信息
     */
    public function findAll()
    {
        $result = array();
        $arr = $this->settingModel->findFull();
        foreach ($arr as $ele) {
            if (!empty($ele['name'])) {
                $result[$ele['name']] = $ele['value'];
            }
        }

        $arr = $this->scriptModel->findFull();
        foreach ($arr as $ele) {
            if (!empty($ele['code'])) {
                $result[$ele['code']] = $ele['script'];
            }
        }
        return $result;
    }


    /**
     * 获取首页标题
     * @return string 首页标题
     */
    public function homeTitle()
    {
        return $this->settingModel->getByKey('home_title');
    }


}