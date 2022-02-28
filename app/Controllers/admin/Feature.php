<?php

namespace App\Controllers\admin;


use App\Models\FeatureModel;
use App\Models\FeatureRecordModel;
use CodeIgniter\HTTP\RedirectResponse;


class Feature extends AbstractAdmin
{

    private $featureModel;
    private $recordModel;

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
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        if ($id > 1) {
            $this->featureModel->deleteById($id);
        }
        return $this->redirect('admin/feature/list');
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
    public function maintain(): RedirectResponse
    {
        $id = $this->postParam('id');
        $name = $this->postParam('name');
        $alias = $this->postParam('alias');
        $keywords = $this->postParam('keywords');
        $brief = $this->postParam('brief');
        $formerCover = $this->postParam('formerCover');
        $formerBackground = $this->postParam('formerBackground');
        $bgRepeat = $this->postParam('bg_repeat');

        $data = array('id' => $id,
            'name' => $name,
            'alias' => $alias,
            'keywords' => $keywords,
            'brief' => $brief,
            'bg_repeat' => $bgRepeat,
        );

        $cover = $this->upload('cover');
        if ($cover[0]) {
            if (!empty($formerCover)) {
                $this->deleteUploadedFile($formerCover);
            }
            $data['cover'] = $cover[1];
        }

        $background = $this->upload('background');
        if ($background[0]) {
            if (!empty($formerBackground)) {
                $this->deleteUploadedFile($formerBackground);
            }
            $data['background'] = $background[1];
        }

        $this->featureModel->insertOrUpdate($data);

        $this->alertSuccess('维护专题信息成功');
        if (empty($id)) {
            return $this->redirect('admin/feature/list');
        } else {
            return $this->redirect('admin/feature/settings/' . $id);
        }
    }


    /**
     * 删除封面
     * @param $id int 专题ID
     * @return RedirectResponse
     */
    public function deleteCover(int $id): RedirectResponse
    {
        $f = $this->featureModel->getById($id);
        $this->deleteFeatureFile($f, 'cover');
        $this->featureModel->updateById($f);
        $this->alertSuccess('删除封面成功');
        return $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 删除背景图
     * @param $id int 专题ID
     * @return RedirectResponse
     */
    public function deleteBg(int $id): RedirectResponse
    {
        $f = $this->featureModel->getById($id);
        $this->deleteFeatureFile($f, 'background');
        $this->featureModel->updateById($f);
        $this->alertSuccess('删除背景图成功');
        return $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 执行删除上传文件操作
     * @param $f array 记录数组
     * @param $target string 上传文件字段
     */
    private function deleteFeatureFile(array &$f, string $target)
    {
        if (!empty($f) && !empty($f[$target])) {
            $path = $f[$target];
            $this->deleteUploadedFile($path);
            $f[$target] = '';
        }
    }


    /**
     * 专题作品列表页
     * @param $featureId int 专题ID
     * @return RedirectResponse
     */
    public function records(int $featureId): RedirectResponse
    {
        $f = $this->featureModel->getById($featureId);
        if (empty($f)) {
            return $this->redirect('admin/feature/list');
        } else {
            $this->adminView('feature-records', $f, $f['name'] . '作品列表');
            die();
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
        $ids = $this->postBody();
        $this->recordModel->deleteByIds($ids);
        echo true;
    }


    /**
     * 调整排序
     * @param $id int 记录ID
     */
    public function changeRecordOrder(int $id)
    {
        $step = $this->postBody();
        echo $this->recordModel->changeOrder($id, $step);
    }
}