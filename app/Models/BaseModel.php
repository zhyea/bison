<?php


namespace App\Models;


use CodeIgniter\Model;

class BaseModel extends Model
{


    protected $table;

    /**
     * Z_Model constructor.
     *
     * @param $table string table name
     */
    public function __construct($table = '')
    {
        if (!empty($table)) {
            $this->table = $table;
        } else {
            $tmp = str_ireplace('model', '', get_called_class());
            $this->table = strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $tmp));
        }
        parent::__construct($validation);
    }


    /**
     * 查询数据库中的第一个数据
     * @param $key string 记录key
     * @param $value object|string 匹配值
     * @return array|object|null 查询结果
     */
    function getFirst(string $key, $value)
    {
        return $this->asArray()
            ->where($key, $value)
            ->first();
    }


    /**
     * 查询数据库中的第一个数据
     * @param $params array 参数集合
     * @return array|object|null 查询结果
     */
    function getFirstByParams(array $params)
    {
        $db = $this->asArray();
        foreach ($params as $k => $v) {
            $db->where($k, $v);
        }
        return $db->first();
    }


    /**
     * 从数组中取值
     * @param $r array|object|string 查询结果
     * @param object|string $defaultValue 默认值
     * @return mixed 目标值
     */
    function takeValue($r, $defaultValue)
    {
        if (is_array($r)) {
            return empty($r) || empty($r['value']) ? $defaultValue : $r['value'];
        }
        return $r;
    }



    function deleteFirst($key, $value){

    }

}