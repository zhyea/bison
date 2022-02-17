<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\WorkModel;
use App\Service\WorkService;


class WorkController extends AbstractController
{


    private $workService;
    private $workModel;


    /**
     * WorkController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
        $this->workModel = new WorkModel();
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
        $params = $this->_post_array();
        $works = $this->workService->find_works($params);
        $this->render_json($works);
    }

    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings($id = 0)
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
     */
    public function delete_cover($id)
    {
        $w = $this->workModel->get_by_id($id);

        if (!empty($w) && !empty($w['cover'])) {
            $path = $w['cover'];
            if (!empty($path) && !(strstr($path, 'nocover.png'))) {
                del_upload_file($path);
            }
            $w['cover'] = '';
        }

        $this->workModel->update($w);
        $this->alertSuccess('删除封面成功');
        $this->redirect('admin/work/settings/' . $id);
    }


    /**
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->_post_array();
        foreach ($ids as $id) {
            $data = $this->workModel->get_by_id($id);
            if (!empty($data['cover'])) {
                del_upload_file($data['cover']);
            }
            $this->workModel->delete_by_id($id);
        }
        echo true;
    }

    /**
     * 作品数据维护
     */
    public function maintain()
    {
        $data = $this->_post();
        $cover = $this->_upload('cover');
        if ($cover[0]) {
            if (!empty($data['former_cover'])) {
                $former_cover = $data['former_cover'];
                if (strcmp($former_cover, 'nocover.png') != 0) {
                    del_upload_file($data['former_cover']);
                }
            }
            $data['cover'] = $cover[1];
        }
        if (empty($data['cover']) && empty($data['former_cover'])) {
            $data['cover'] = 'nocover.png';
        }
        $data = array_key_rm('cat', $data);
        $data = array_key_rm('author', $data);
        $data = array_key_rm('country', $data);
        $data = array_key_rm('former_cover', $data);

        $this->workModel->insert_or_update($data);
        $this->alertSuccess('维护作品信息成功');
        $this->cacheService->clean();

        if (empty($data['id'])) {
            $this->redirect('admin/work/list');
        } else {
            $this->redirect('admin/work/settings/' . $data['id']);
        }
    }


    /**
     * 获取作者作品信息
     * @param $author_id int 作者ID
     */
    public function author($author_id)
    {
        $params = $this->_post_array();
        $works = $this->workService->find_with_author_con($author_id, $params);
        $this->render_json($works);
    }


    /**
     * 获专题作品信息
     * @param $feature_alias string 专题别名
     */
    public function feature($feature_alias)
    {
        $params = $this->_post_array();
        $works = $this->workService->find_with_feature_con($feature_alias, $params);
        $this->render_json($works);
    }

    /**
     * 查询推荐的作品信息
     */
    public function suggest()
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->workService->find_with_keywords($keywords);
        $this->render_json(array('key' => $keywords, 'value' => $data));
    }


}