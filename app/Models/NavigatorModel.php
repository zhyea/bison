<?php


namespace App\Models;


use ReflectionException;

class NavigatorModel extends BaseModel
{


    /**
     * 根据父ID获取数据
     * @param int $parent 父分类ID
     * @return array 分类数据
     */
    public function findByParent(int $parent)
    {
        return $this->asArray()
            ->where('parent', $parent)
            ->orderBy('sn', 'DESC')
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
     * 调整菜单排序
     * @param int $id 记录ID
     * @param int $step 排序步长
     *
     * @return bool 是否修改成功
     */
    public function changeOrder(int $id, int $step)
    {
        try {
            if (!is_int($step)) {
                die();
            }
            $frag = 'sn+' . $step;
            if ($step < 0) {
                $frag = 'sn' . $step;
            }
            return $this->protect(false)
                ->set('sn', $frag, false)
                ->update($id);
        } catch (ReflectionException $e) {
            return false;
        }
    }


    /**
     * 执行递归删除
     * @param int $rootId 根ID
     * @return bool 是否删除成功
     */
    public function deleteRecursively(int $rootId)
    {
        $ids = $this->offspringIds($rootId);
        return $this->whereIn('id', $ids)->delete($ids);
    }


    /**
     * 查询全部导航信息
     */
    public function all()
    {
        return $this->asArray()
            ->orderBy('sn', 'desc')
            ->orderBy('id', 'asc')
            ->findAll();
    }
}