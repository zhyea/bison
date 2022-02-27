<?php

namespace App\Controllers\admin;


use App\Models\AuthorModel;
use App\Models\WorkModel;
use CodeIgniter\HTTP\RedirectResponse;

class Author extends AbstractAdmin
{


    private $authorModel;
    private $workModel;

    public function __construct()
    {
        parent::__construct();
        $this->authorModel = new AuthorModel();
        $this->workModel = new WorkModel();
    }


    /**
     * 进入列表页
     */
    public function list()
    {
        $this->adminView('author-list', array(), '作者列表');
    }


    /**
     * 列表页数据
     */
    public function data()
    {
        $all = $this->authorModel->findAll();
        foreach ($all as &$a) {
            $id = $a['id'];
            $cnt = $this->workModel->countWithAuthor($id);
            $a['work_count'] = $cnt;
        }
        $this->renderJson($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete(int $id): RedirectResponse
    {
        if ($id > 1) {
            $this->authorModel->deleteById($id);
        }
        return $this->redirect('admin/author/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings(int $id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->authorModel->getById($id);
        }
        $this->adminView('author-settings', $s, empty($s) ? '新增作者' : '编辑作者信息');
    }


    /**
     * 维护脚本信息
     */
    public function maintain(): RedirectResponse
    {
        $data = $this->postParams();
        $this->authorModel->insertOrUpdate($data);
        return $this->redirect('admin/author/list');
    }


    /**
     * 查询推荐的作者信息
     */
    public function suggest()
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->authorModel->suggest($keywords);
        $this->renderJson(array('key' => $keywords, 'value' => $data));
    }


    /**
     * 根据作者ID查询作品信息
     * @param $authorId int 作者ID
     */
    public function works(int $authorId): RedirectResponse
    {
        $author = $this->authorModel->getById($authorId);
        if (empty($author)) {
            return $this->redirect('admin/author/list');
        }
        $this->adminView('author-works', $author, $author['name'] . '作品列表');
        die();
    }

}