<?php
namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Models\VolumeModel;

class Volume extends AbstractController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new VolumeModel();
    }


    /**
     * 查询推荐的分类信息
     * @param $work_id int 作品ID
     */
    public function suggest($work_id)
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->model->suggest($work_id, $keywords);
        $this->renderJson(array('key' => $keywords, 'value' => $data));
    }


}