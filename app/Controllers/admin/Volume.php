<?php
namespace App\Controllers\admin;


use App\Models\VolumeModel;

class Volume extends AbstractAdmin
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new VolumeModel();
    }


    /**
     * 查询推荐的分类信息
     * @param $workId int 作品ID
     */
    public function suggest(int $workId)
    {
        $keywords = $this->getParam('key');
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->model->suggest($workId, $keywords);
        $this->renderJson(array('key' => $keywords, 'value' => $data));
    }


}