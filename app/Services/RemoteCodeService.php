<?php

namespace App\Services;

use App\Models\RemoteCodeModel;

class RemoteCodeService extends BaseService
{

    private $rcModel;


    public function __construct()
    {
        $this->rcModel = new RemoteCodeModel();
    }


    public function set($user)
    {
        if (empty($user)) {
            return;
        }
        $rc = $this->rcModel->getByUser($user['id']);
        $time = 0;
        if (empty($rc)) {
            $rc = array();
            $rc['user_id'] = $user['id'];
        } else {
            $t = $rc['op_time'];
            $time = strtotime($t);
        }

        $diff = (time() - $time) / 60;
        if ($diff < 40) {
            return;
        }
        $rc['code'] = strtoupper(uniqid());
        $rc['op_time'] = date('Y-m-d H:i:s', time());
        $this->rcModel->insertOrUpdate($rc);
    }


    public function getLatest($user)
    {
        if (empty($user)) {
            return array('code' => '未知错误', 'expire_time' => '无法确定');
        }
        $rc = $this->rcModel->getByUser($user['id']);
        $time = strtotime($rc['op_time']) + 60 * 50;
        $code = $rc['code'];
        return array('code' => $code, 'expire_time' => date('Y-m-d H:i:s', $time));
    }


    /**
     * 校验远程码是否有效
     * @param string $code 远程码
     * @return array|null 远程码对象
     */
    public function validCode(string $code)
    {
        $rc = $this->rcModel->getByCode($code);
        if (empty($rc)) {
            return null;
        }
        $time = strtotime($rc['op_time']);
        $diff = ($time - time()) / 60 + 60;

        if ($diff < 0) {
            return null;
        }
        return $rc;
    }


}