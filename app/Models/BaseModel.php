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
    function getLatest(string $key, $value)
    {
        return $this->asArray()
            ->where($key, $value)
            ->orderBy('id', 'desc')
            ->first();
    }


    /**
     * 查询数据库中的第一个数据
     * @param $params array 参数集合
     * @return array|object|null 查询结果
     */
    function getLatestByParams(array $params)
    {
        $db = $this->asArray();
        foreach ($params as $k => $v) {
            $db->where($k, $v);
        }
        $db->orderBy('id', 'desc');
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


    /**
     * 执行count查询
     * @param array $params 查询参数
     * @return int 统计结果
     */
    function countBy(array $params)
    {
        $db = $this->asObject()
            ->selectCount('id', 'cnt');
        foreach ($params as $k => $v) {
            $db->where($k, $v);
        }
        $obj = $db->first();
        return $obj->cnt;
    }


    /**
     * 获取后代ID集合
     * @param mixed $rootId 根ID值
     * @param string $idColumn ID字段
     * @param string $parentColumn 父ID字段
     * @return array ID及后代ID集合
     */
    function offspringIds($rootId, string $idColumn = 'id', string $parentColumn = 'parent')
    {
        $result = array($rootId);
        $r = $this->asArray()
            ->select($idColumn)
            ->where($parentColumn, $rootId)
            ->findAll();
        foreach ($r as $i) {
            $id = $i[$idColumn];
            array_push($result, $id);
            $childrenIds = $this->offspringIds($id, $parentColumn);
            if (empty($childrenIds)) {
                continue;
            }
            $result = array_merge($result, $childrenIds);
        }
        return $result;
    }


}