<?php

namespace App\Services;


use App\Models\CategoryModel;
use App\Models\FeatureModel;
use App\Models\NavigatorModel;

class NavigatorService
{
    private $navModel;
    private $catModel;
    private $featureModel;


    public function __construct()
    {
        $this->navModel = new NavigatorModel();
        $this->catModel = new CategoryModel();
        $this->featureModel = new FeatureModel();

        helper('arr');
    }


    /**
     * 展示列表数据
     * @param $parent int 父ID
     * @return array 子元素数据
     */
    public function listData(int $parent)
    {
        $children = $this->navModel->findByParent($parent);
        if (empty($children)) {
            return $children;
        }
        foreach ($children as &$c) {
            $id = $c['id'];
            $count = $this->navModel->countByParent($id);
            $c['sub_count'] = $count;
        }
        return $children;
    }


    /**
     * 获取备选父分类
     * @param $id int 分类ID
     * @param $parent int 分类父ID
     * @return array 获取备选父分类集合
     */
    public function candidateParent(int $id, int $parent = 0)
    {
        $result = array();
        $all = $this->navModel->findAll();
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
     * 获取备选项
     * @return array 获取备选集合
     */
    public function candidateTree()
    {
        $categories = $this->categories();
        $features = $this->features();
        $urls = $this->urls();
        return array($categories, $features, $urls);
    }

    /**
     * 构建分类树
     * @return array 分类树节点
     */
    private function categories()
    {
        $root = array('text' => '分类');
        $all = $this->catModel->findAll();
        foreach ($all as &$cat) {
            $cat['text'] = $cat['name'];
            $cat['ext'] = '/c/' . $cat['slug'] . '.html';
            $cat['ext2'] = 'category';
        }
        return build_tree($all, $root, 'id', 'parent', 'nodes');
    }


    /**
     * 构建专题树
     * @return array 专题树节点
     */
    private function features()
    {
        $root = array('text' => '专题');
        $all = $this->featureModel->findAll();
        foreach ($all as &$f) {
            $f['text'] = $f['name'];
            $f['ext'] = '/f/' . $f['alias'] . '.html';
            $f['ext2'] = 'category';
        }
        return build_tree($all, $root, 'id', 'parent', 'nodes');
    }


    /**
     * 自定义链接树
     * @return array 自定义链接树
     */
    private function urls()
    {
        $root = array('text' => '自定义', 'id' => 0);
        $root['nodes'] = array(array('id' => 0, 'text' => '自定义链接', 'ext' => 'url', 'ext2' => 'custom'));
        return $root;
    }


    /**
     * @return array 导航树
     */
    public function navigator()
    {
        $nav = array('id' => 0, 'children' => array());
        $all = $this->navModel->all();
        return build_tree($all, $nav);
    }


}