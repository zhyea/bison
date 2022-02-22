<?php


namespace App\Controllers\admin;


use App\Controllers\AbstractController;

class AbstractAdmin extends AbstractController
{


    protected $req;
    protected $session;

    public function __construct()
    {
        $this->req = service('request');
        $this->session = session();
        parent::__construct();
    }


    /**
     * 从get请求中获取参数
     * @param string $key 请求key
     * @return mixed 参数值
     */
    protected function getParam(string $key)
    {
        return $this->req->getGet($key);
    }


    /**
     * 从post请求中获取参数
     * @param string $key 请求key
     * @return mixed 参数值
     */
    protected function postParam(string $key)
    {
        return $this->req->getPost($key);
    }


    /**
     * 读取上传的文件
     * @param string $key 请求key
     * @return mixed 文件信息
     */
    protected function getFile(string $key)
    {
        return $this->req->getFile($key);
    }


    /**
     * 从session中取值
     * @param string $key session key
     * @param mixed $defaultVal 默认值
     * @return mixed session中的值
     */
    protected function sessionOf(string $key, $defaultVal = '')
    {
        $val = $this->session->get($key);
        return empty($val) ? $defaultVal : $val;
    }


    /**
     * 设置session中的值
     * @param string $key session key
     * @param mixed $val 值
     */
    protected function setSession(string $key, $val)
    {
        $this->session->set($key, $val);
    }

    /**
     * 移除session中的值
     * @param string $key session key
     */
    protected function rmSession(string $key)
    {
        $this->session->remove($key);
    }


    /**
     * 添加提示信息
     *
     * @param $msg string 提示内容
     * @param $type string 提示类型，对应bootstrap alert类
     */
    protected function addAlert(string $msg, string $type)
    {
        $this->setSession('alert', array('type' => $type, 'msg' => $msg));
    }


    /**
     * 提示成功信息
     * @param $msg string 提示信息
     */
    protected function alertSuccess(string $msg)
    {
        $this->addAlert($msg, 'success');
    }


    /**
     * 提示错误信息
     * @param $msg string 提示信息
     */
    protected function alertDanger(string $msg)
    {
        $this->addAlert($msg, 'danger');
    }


    /**
     * 展示json
     *
     * @param mixed $obj 对象
     */
    protected function renderJson($obj)
    {
        echo json_encode($obj);
    }
}