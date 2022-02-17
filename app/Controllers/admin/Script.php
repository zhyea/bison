<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\ScriptModel;


class Script extends AbstractController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ScriptModel();
    }


    /**
     * 进入列表页
     */
    public function list()
    {
        $this->adminView('script-list', array(), '脚本列表');
    }


    /**
     * 列表页数据
     */
    public function data()
    {
        $all = $this->model->find_all();
        $this->renderJson($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete($id)
    {
        if ($id > 6) {
            $this->model->delete_by_id($id);
        }
        $this->redirect('admin/spt/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function edit($id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->model->get_by_id($id);
        }
        $this->adminView('script-settings', $s, empty($s) ? '新增脚本' : '编辑脚本');
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->_post();
        $this->model->insert_or_update($data);
        $this->redirect('admin/spt/list');
    }

}