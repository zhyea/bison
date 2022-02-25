<?php

namespace App\Controllers\admin;


use App\Models\UserModel;

class User extends AbstractAdmin
{

    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }


    /**
     * 进入用户信息编辑页
     *
     * @param $id int 用户ID
     */
    public function settings($id = 0)
    {
        $user = $this->model->getById($id);
        $user = empty($user) ? array() : $user;
        $this->adminView('user-settings', $user, $id > 0 ? '编辑用户信息' : '新增用户');
    }


    /**
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->postBody();
        echo $this->model->deleteByIds($ids);
    }


    /**
     * 用户信息维护
     */
    public function maintain()
    {
        $data = $this->postParams();
        $username = $data['username'];
        $user = $this->model->getByUsername($username);
        if (!empty($data['id']) && !empty($user) && ($data['id'] != $user['id'])) {
            $this->alertDanger('用户名已存在');
            return $this->redirect('admin/user/settings');
        } else {
            $data['password'] = md5($data['password'] . '#_淦x7');
            $this->model->insertOrUpdate($data);
            $this->alertSuccess('用户信息保存成功');
            return $this->redirect('admin/user/list');
        }
    }


    /**
     * 用户信息列表
     */
    public function list()
    {
        $this->adminView('user-list', array(), '用户列表');
    }

    /**
     * 获取用户数据
     */
    public function data()
    {
        $r = $this->model->findAll();
        $this->renderJson($r);
    }
}