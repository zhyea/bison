<?php


namespace App\Models;


use ReflectionException;

class VolumeModel extends BaseModel
{


    /**
     * 根据作品ID查找分卷
     * @param int $workId 作品ID
     * @return array 分卷集合
     */
    public function findByWorkId(int $workId)
    {
        if ($workId <= 0) {
            return array();
        }
        return $this->asArray()
            ->where('work_id', $workId)
            ->orderBy('id')
            ->findAll();
    }


    /**
     * 查询推荐的分卷信息
     * @param int $workId 作品ID
     * @param string $keyword 关键字ID
     * @return array 查询结果
     */
    public function suggest(int $workId, string $keyword)
    {
        return $this->select(array('id', 'name'))
            ->where('work_id', $workId)
            ->like('name', $keyword)
            ->orderBy('id', 'DESC')
            ->findAll(9);
    }


    /**
     * 根据作品ID和分卷名称查询记录
     * @param int $workId 作品ID
     * @param string $name 分卷名称
     * @return array 分卷记录
     */
    public function getByWorkAndName(int $workId, string $name)
    {
        return $this->getLatestByParams(array('work_id' => $workId, 'name' => $name));
    }


    /**
     * 根据作品ID查询最新分卷记录
     * @param int $workId 作品ID
     * @return array|object|null 作品最新分卷
     */
    public function getLatestByWorkId(int $workId)
    {
        return $this->getLatest('work_id', $workId);
    }


    /**
     * 新增分卷
     * @param int $workId 作品ID
     * @param string $name 分卷名称
     * @return mixed 是否新增成功
     */
    public function add(int $workId, string $name)
    {
        try {
            return $this->insert(array('work_id' => $workId, 'name' => $name));
        } catch (ReflectionException $e) {
            return false;
        }
    }


    /**
     * 根据作品ID执行删除
     * @param int $workId 作品ID
     * @return bool|string 是否删除成功
     */
    public function deleteByWork(int $workId)
    {
        return $this->where('work_id', $workId)->delete();
    }

}