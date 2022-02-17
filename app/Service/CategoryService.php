<?php

namespace App\Service;


use App\Models\CategoryModel;
use App\Models\WorkModel;

class CategoryService
{

    private $catModel;

    private $workModel;


    public function __construct()
    {
        $this->catModel = new CategoryModel();
        $this->workModel = new WorkModel();
    }


    /**
     * 展示列表数据
     * @param int $parent 父ID
     * @return array 子元素数据
     */
    public function listData(int $parent)
    {
        $children = $this->catModel->findByParent($parent);
        if (empty($children)) {
            return $children;
        }
        foreach ($children as &$c) {
            $id = $c['id'];
            $count = $this->catModel->countByParent($id);
            $c['sub_count'] = $count;
        }
        return $children;
    }


    /**
     * 获取备选父分类
     * @param int $id 分类ID
     * @param int $parent 分类父ID
     * @return array 获取备选父分类集合
     */
    public function candidates(int $id, int $parent = 0)
    {
        $all = $this->catModel->findAll();
        $result = array();
        foreach ($all as $c) {
            if ($c['id'] == $id) {
                continue;
            }
            if ($parent > 0 && $parent == $c['parent']) {
                continue;
            }
            array_push($result, $c);
        }
        return $result;
    }


    /**
     * 执行删除操作，会删除当前分类以及子分类
     * @param int $rootId 分类ID
     * @return bool 是否删除成功
     */
    public function deleteRecursively(int $rootId)
    {

        $ids = $this->catModel->offspringIds($rootId);
        $r = array();
        foreach ($ids as $id) {
            if ($id == 1) {
                continue;
            }
            $this->workModel->changeCategory($id, 1);
            array_push($r, $id);
        }
        return $this->catModel->deleteByIds($r);
    }
}