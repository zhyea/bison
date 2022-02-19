<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\CategoryModel;
use App\Services\CategoryService;

class Category extends AbstractController
{

    private $model;

    private $service;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
        $this->service = new CategoryService();
    }


    /**
     * 分类信息列表
     * @param $id int 分类ID
     * @param $parent int 父分类ID
     */
    public function list($id = 0, $parent = 0)
    {
        $cat = $this->model->get_by_id($id);
        $title = '分类列表';
        if (!empty($cat)) {
            $title = $title . '-' . $cat['name'];
            $parent = $cat['parent'];
        }
        $this->adminView('cat-list', array('id' => $id, 'parent' => $parent, 'header_title' => $title), $title);
    }


    /**
     * 获取父分类数据
     * @param $parent int 分父类ID
     */
    public function data($parent = 0)
    {
        $data = $this->service->list_data($parent);
        $this->renderJson($data);
    }


    /**
     * 进入分类编辑页
     * @param $id int 分类ID
     * @param $parent int 分类父ID
     */
    public function settings($id = 0, $parent = 0)
    {
        $cat = $this->model->get_by_id($id);
        $parent = empty($cat) ? $parent : $cat['parent'];
        $cat = empty($cat) ? array() : $cat;
        $candidates = $this->service->candidates($id, $parent);
        $cat['candidates'] = $candidates;
        $cat['id'] = $id;
        $cat['parent'] = $parent;
        $this->adminView('cat-settings', $cat, empty($cat) ? '新增分类' : '编辑分类');
    }


    /**
     * 分类信息维护
     */
    public function maintain()
    {
        $cat = $this->_post();

        $this->model->insert_or_update($cat);

        $this->redirect('admin/category/list');
    }


    /**
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->_post_array();
        foreach ($ids as $id) {
            $this->service->delete_recursively($id);
        }
        echo true;
    }


    /**
     * 调整排序
     * @param $id int 记录ID
     */
    public function change_order($id)
    {
        $step = $this->_post_body();
        echo $this->model->change_order($id, $step);
    }

    
    /**
     * 查询推荐的分类信息
     */
    public function suggest()
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->model->suggest($keywords);
        $this->renderJson(array('key' => $keywords, 'value' => $data));
    }
}