<?php


namespace App\Models;


use ReflectionException;

/**
 * 分类Model
 * Class CategoryModel
 * @package App\Models
 */
class CategoryModel extends BaseModel
{


    /**
     * 根据父ID获取数据
     * @param int $parent 父ID
     * @return array 分类数据
     */
    public function findByParent(int $parent)
    {
        return $this->asArray()
            ->where('parent', $parent)
            ->orderBy('sn', 'desc')
            ->findAll();
    }


    /**
     * 根据父ID执行统计
     * @param int $parent 父ID
     * @return int 统计结果
     */
    public function countByParent(int $parent)
    {
        return $this->countBy(array('parent' => $parent));
    }


    /**
     * 调整排序步长
     * @param int $id 分类ID
     * @param int $step 排序步长
     *
     * @return bool 更新是否成功
     */
    public function changeOrder(int $id, int $step)
    {
        try {
            return $this->update($id, array('sn' => 'sn+' . $step));
        } catch (ReflectionException $e) {
            return false;
        }
    }


    /**
     * 查询推荐的分类信息
     * @param string $keyword 关键字
     * @return array 查询结果
     */
    public function suggest(string $keyword)
    {
        return $this->asArray()
            ->select(array('id', 'name', 'slug'))
            ->like('name', $keyword)
            ->orLike('slug', $keyword)
            ->orderBy('id', 'desc')
            ->findAll(9);
    }


    /**
     * 根据缩略名获取分类
     * @param string $slug 缩略名
     * @return array|object|null 分类信息
     */
    public function getBySlug(string $slug)
    {
        return $this->getLatestByParams(array('slug' => $slug));
    }


    /**
     * 查询全部分类信息
     */
    public function all()
    {
        return $this->asArray()
            ->orderBy('sn', 'desc')
            ->orderBy('id', 'asc')
            ->findAll();
    }

}