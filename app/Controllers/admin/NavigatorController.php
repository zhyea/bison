<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\NavigatorModel;
use App\Service\NavigatorService;


class NavigatorController extends AbstractController
{
    private $model;

    private $navService;

    private $cacheService;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new NavigatorModel();
        $this->navService = new NavigatorService();
    }


    /**
     * 导航列表
     * @param $id int ID
     * @param $parent int 父ID
     */
    public function list($id = 0, $parent = 0)
    {
        $nav = $this->model->get_by_id($id);
        $title = '导航列表';
        if (!empty($nav)) {
            $title = $title . '-' . $nav['name'];
            $parent = $nav['parent'];
        }
        $this->adminView('nav-list', array('id' => $id, 'parent' => $parent, 'header_title' => $title), $title);
    }


    /**
     * 获取父项数据
     * @param $parent int 父ID
     */
    public function data($parent = 0)
    {
        $data = $this->navService->list_data($parent);
        $this->render_json($data);
    }


    /**
     * 进入导航编辑页
     * @param $id int ID
     * @param $parent int 父ID
     */
    public function settings($parent = 0, $id = 0)
    {
        $nav = $this->model->get_by_id($id);
        $parent = array_value_of('parent', $nav, $parent);
        $candidates = $this->navService->candidate_parent($id, $parent);
        $nav['candidates'] = $candidates;
        $nav['id'] = $id;
        $nav['parent'] = $parent;
        $nav['type'] = array_value_of('type', $nav, '');
        $this->adminView('nav-settings', $nav, $id <= 0 ? '新增导航' : '编辑导航');
    }


    /**
     * 分类信息维护
     */
    public function maintain()
    {
        $cat = $this->_post();

        $this->model->insert_or_update($cat);
        $this->cacheService->clean();

        $this->redirect('admin/nav/list');
    }


    /**
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->_post_array();
        foreach ($ids as $id) {
            $this->model->delete_recursively($id);
        }
        $this->cacheService->clean();
        echo true;
    }


    /**
     * 调整排序
     * @param $id int 记录ID
     */
    public function change_order($id)
    {
        $step = $this->_post_body();
        $this->cacheService->clean();
        echo $this->model->change_order($id, $step);
    }


    /**
     * 获取备选信息
     */
    public function candidates()
    {
        $data = $this->navService->candidate_tree();
        $this->render_json($data);
    }

}