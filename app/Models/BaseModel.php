<?php


namespace App\Models;


use CodeIgniter\Database\BaseResult;
use CodeIgniter\Model;
use ReflectionException;

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
            $arr = explode('\\', get_called_class());
            $tmp = str_ireplace('model', '', end($arr));
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
    function countBy(array $params): int
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
    function offspringIds($rootId, string $idColumn = 'id', string $parentColumn = 'parent'): array
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


    /**
     * 根据ID查询记录
     * @param int $id 记录ID
     * @return array 记录信息
     */
    public function getById(int $id)
    {
        return $this->getLatestByParams(array('id' => $id));
    }


    /**
     * 根据ID更新记录
     * @param array $arr 记录对应的数组
     * @return bool 是否更新成功
     */
    public function updateById(array $arr): bool
    {
        if (!empty($arr['id'])) {
            try {
                $id = $arr['id'];
                $data = array_key_rm('id', $arr);
                return $this->protect(false)->update($id, $data);
            } catch (ReflectionException $e) {
                return false;
            }
        }
        return false;
    }


    /**
     * 写入数据到数据库，不抛出异常
     * @param array $arr 记录对应的数据
     * @return BaseResult|false|int|object|string 写入结果
     */
    public function insertSilent(array $arr)
    {
        if (!empty($arr)) {
            try {
                return $this->protect(false)->insert($arr);
            } catch (ReflectionException $e) {
                return false;
            }
        }
        return false;
    }


    /**
     * 写入或更新数据
     * @param array $arr 记录对应的数据
     * @return bool|BaseResult|int|object|string 处理结果
     */
    public function insertOrUpdate(array $arr)
    {
        if (empty($arr)) {
            return false;
        }
        if (!empty($arr['id'])) {
            return $this->updateById($arr);
        } else {
            return $this->insertSilent($arr);
        }
    }


    /**
     * 根据ID执行删除
     * @param int $id 记录ID
     * @return bool 是否删除成功
     */
    public function deleteById(int $id): bool
    {
        return $this->delete(array('id' => $id));
    }


    /**
     * 根据ID执行删除
     * @param array $ids id集合
     * @return bool 是否删除成功
     */
    public function deleteByIds(array $ids): bool
    {
        $this->whereIn('id', $ids);
        return $this->protect(false)->delete();
    }


    /**
     * 查询数据库中的全部记录
     * @return array 全部记录
     */
    public function findFull(): array
    {
        return $this->asArray()
            ->orderBy('id', 'desc')
            ->findAll();
    }
}