<?php

namespace App\Controllers\admin;


use App\Models\ScriptModel;
use CodeIgniter\HTTP\RedirectResponse;


class Script extends AbstractAdmin
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
        $all = $this->model->findAll();
        $this->renderJson($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     * @return RedirectResponse
     */
    public function delete(int $id)
    {
        if ($id > 6) {
            $this->model->deleteById($id);
        }
        return $this->redirect('admin/spt/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     * @return RedirectResponse
     */
    public function edit(int $id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->model->getById($id);
        }
        if (empty($s)) {
            return $this->redirect('admin/spt/list');
        }
        $this->adminView('script-settings', $s, empty($s) ? '新增脚本' : '编辑脚本');
        die();
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->postParams();
        $this->model->insertOrUpdate($data);
        return $this->redirect('admin/spt/list');
    }

}