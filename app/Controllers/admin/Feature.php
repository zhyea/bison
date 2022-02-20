<?php

namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\FeatureModel;
use App\Models\FeatureRecordModel;


class Feature extends AbstractController
{

    private $featureModel;

    private $recordModel;

    private $cacheService;

    public function __construct()
    {
        parent::__construct();
        $this->featureModel = new FeatureModel();
        $this->recordModel = new FeatureRecordModel();
    }


    /**
     * 进入列表页
     */
    public function list()
    {
        $this->adminView('feature-list', array(), '专题列表');
    }


    /**
     * 列表页数据
     */
    public function data()
    {
        $all = $this->featureModel->findFull();
        foreach ($all as &$f) {
            $cnt = $this->recordModel->countWithFeature($f['id']);
            $f['count'] = $cnt;
        }
        $this->renderJson($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete(int $id)
    {
        if ($id > 1) {
            $this->featureModel->deleteById($id);
        }
        $this->cacheService->clean();
        $this->redirect('admin/feature/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings(int $id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->featureModel->getById($id);
        }
        $this->adminView('feature-settings', $s, empty($s) ? '新增专题' : '编辑专题');
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->_post();

        $cover = $this->_upload('cover');
        if ($cover[0]) {
            if (!empty($data['former_cover'])) {
                del_upload_file($data['former_cover']);
            }
            $data['cover'] = $cover[1];
        }
        $data = array_key_rm('former_cover', $data);

        $background = $this->_upload('background');
        if ($background[0]) {
            if (!empty($data['former_background'])) {
                del_upload_file($data['former_background']);
            }
            $data['background'] = $background[1];
        }
        $data = array_key_rm('former_background', $data);

        $this->featureModel->insertOrUpdate($data);
        $this->cacheService->clean();

        $this->alertSuccess('维护专题信息成功');
        if (empty($data['id'])) {
            $this->redirect('admin/feature/list');
        } else {
            $this->redirect('admin/feature/settings/' . $data['id']);
        }
    }


    /**
     * 删除封面
     * @param $id int 专题ID
     */
    public function deleteCover(int $id)
    {
        $f = $this->featureModel->getById($id);
        $this->_delete_file($f, 'cover');
        $this->featureModel->updateById($f);
        $this->cacheService->clean();
        $this->alertSuccess('删除封面成功');
        $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 删除背景图
     * @param $id int 专题ID
     */
    public function deleteBg(int $id)
    {
        $f = $this->featureModel->getById($id);
        $this->_delete_file($f, 'background');
        $this->featureModel->updateById($f);
        $this->cacheService->clean();
        $this->alertSuccess('删除背景图成功');
        $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 执行删除上传文件操作
     * @param $f array 记录数组
     * @param $target string 上传文件字段
     */
    private function _delete_file(array &$f, string $target)
    {
        if (!empty($f) && !empty($f[$target])) {
            $path = $f[$target];
            del_upload_file($path);
            $f[$target] = '';
        }
    }


    /**
     * 专题作品列表页
     * @param $featureId int 专题ID
     */
    public function records(int $featureId)
    {
        $f = $this->featureModel->getById($featureId);
        if (empty($f)) {
            $this->redirect('admin/feature/list');
        } else {
            $this->adminView('feature-records', $f, $f['name'] . '作品列表');
        }
    }


    /**
     * 新增专题记录
     * @param $featureId int 专题ID
     * @param $workId int 作品ID
     */
    public function addRecord(int $featureId, int $workId)
    {
        $this->recordModel->insertSilent(array('type' => 1, 'feature_id' => $featureId, 'work_id' => $workId));
    }


    /**
     * 删除专题记录
     */
    public function deleteRecords()
    {
        $ids = $this->_post_array();
        $this->recordModel->deleteByIds($ids);
        echo true;
    }


    /**
     * 调整排序
     * @param $id int 记录ID
     */
    public function changeRecordOrder(int $id)
    {
        $step = $this->_post_body();
        echo $this->recordModel->changeOrder($id, $step);
    }
}