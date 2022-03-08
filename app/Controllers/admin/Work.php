<?php

namespace App\Controllers\admin;


use App\Models\AuthorModel;
use App\Models\WorkModel;
use App\Services\WorkService;
use CodeIgniter\HTTP\RedirectResponse;


class Work extends AbstractAdmin
{

    private $workService;
    private $workModel;
    private $authorModel;


    /**
     * Work constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
        $this->workModel = new WorkModel();
        $this->authorModel = new AuthorModel();
    }


    /**
     * 作品列表
     */
    public function list()
    {
        $this->adminView('work-list', array(), '作品列表');
    }


    /**
     * 作品数据
     */
    public function data()
    {
        $params = $this->postBody();
        $works = $this->workService->findWorks($params);
        $this->renderJson($works);
    }

    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings(int $id = 0)
    {
        $work = array('id' => $id);
        if ($id > 0) {
            $work = $this->workService->get($id);
        }
        $this->adminView('work-settings', $work, empty($work) ? '新增作品' : '编辑作品信息');
    }


    /**
     * 删除封面
     * @param $id int 专题ID
     * @return RedirectResponse
     */
    public function deleteCover(int $id): RedirectResponse
    {
        $w = $this->workModel->getById($id);
        $data = array('id' => $id);
        if (!empty($w) && !empty($w['cover'])) {
            $path = $w['cover'];
            if (!empty($path) && !(strstr($path, 'default/nocover.png'))) {
                $this->deleteUploadedFile($path);
            }
            $data['cover'] = '';
            $this->workModel->updateById($data);
        }

        $this->alertSuccess('删除封面成功');
        return $this->redirect('admin/work/settings/' . $id);
    }


    /**
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->postBody();
        foreach ($ids as $id) {
            $data = $this->workModel->getById($id);
            if (!empty($data['cover'])) {
                $this->deleteUploadedFile($data['cover']);
            }
            $this->workModel->deleteById($id);
        }
        echo true;
    }

    /**
     * 作品数据维护
     */
    public function maintain(): RedirectResponse
    {
        $formerCover = $this->postParam('formerCover');
        $cover = $this->upload('cover');
        $id = $this->postParam('id');
        $name = $this->postParam('name');
        $authorId = $this->postParam('authorId');
        $author = $this->postParam('author');
        $country = $this->postParam('country');
        $categoryId = $this->postParam('categoryId');
        $brief = $this->postParam('brief');

        $data = array();
        if ($cover[0]) {
            if (!empty($formerCover)) {
                if (strcmp($formerCover, 'default/nocover.png') != 0) {
                    $this->deleteUploadedFile($formerCover);
                }
            }
            $data['cover'] = $cover[1];
        }
        if (empty($data['cover']) && empty($formerCover)) {
            $data['cover'] = 'default/nocover.png';
        }
        $authorId = $this->authorModel->maintain($authorId, $author, $country);

        $data['id'] = $id;
        $data['author_id'] = $authorId;
        $data['category_id'] = $categoryId;
        $data['name'] = $name;
        $data['brief'] = $brief;

        $this->workModel->insertOrUpdate($data);
        $this->alertSuccess('维护作品信息成功');

        if (empty($id)) {
            return $this->redirect('admin/work/list');
        } else {
            return $this->redirect('admin/work/settings/' . $id);
        }
    }


    /**
     * 获取作者作品信息
     * @param $authorId int 作者ID
     */
    public function author(int $authorId)
    {
        $params = $this->postBody();
        $works = $this->workService->findWithAuthorCon($authorId, $params);
        $this->renderJson($works);
    }


    /**
     * 获专题作品信息
     * @param $featureAlias string 专题别名
     */
    public function feature(string $featureAlias)
    {
        $params = $this->postBody();
        $works = $this->workService->findWithFeatureCon($featureAlias, $params);
        $this->renderJson($works);
    }

    /**
     * 查询推荐的作品信息
     */
    public function suggest()
    {
        $keywords = $this->getParam('key');
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->workService->findWithKeywords($keywords);
        $this->renderJson(array('key' => $keywords, 'value' => $data));
    }


}