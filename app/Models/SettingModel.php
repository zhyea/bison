<?php


namespace App\Models;


/**
 * 设置表Model
 * Class SettingModel
 * @package App\Models
 */
class SettingModel extends BaseModel
{


    protected $primaryKey = 'name';

    /**
     * 根据Key获取配置信息
     *
     * @param $key string 配置名称
     * @param $defaultValue string 配置默认值
     * @return string 配置值
     */
    public function getByKey(string $key, string $defaultValue = '')
    {
        $r = $this->getFirst('name', $key);
        return $this->takeValue($r, $defaultValue);
    }


    /**
     * 根据Key删除配置信息
     *
     * @param $key string 配置名称
     */
    public function deleteByKey(string $key)
    {
        $this->delete($key);
    }


    /**
     * 更新配置信息
     *
     * @param $name string 配置项名称
     * @param $value string 配置项值
     * @return bool 是否更新成功
     */
    public function change(string $name, string $value)
    {
        return $this->replace(array('name' => $name, 'value' => $value));
    }


    /**
     * 删除配置项
     *
     * @param $settingName string 配置项名称
     * @return bool 是否删除成功
     */
    public function deleteSetting(string $settingName)
    {
        return $this->delete($settingName);
    }
}