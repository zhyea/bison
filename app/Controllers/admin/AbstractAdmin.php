<?php


namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

class AbstractAdmin extends AbstractController
{


    protected $req;
    protected $session;
    private $pathUpload;

    public function __construct()
    {
        helper('string');
        $this->req = service('request');
        $this->session = session();
        $this->pathUpload = FCPATH . 'upload/';

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
     * @return UploadedFile 上传的文件
     */
    protected function getFile(string $key)
    {
        return $this->req->getFile($key);
    }


    /**
     * 获取POST请求中的全部内容
     * @return array 请求中的全部内容
     */
    protected function postParams(): array
    {
        return $this->req->getRawInput();
    }


    /**
     * 获取请求体
     * @return mixed 请求体
     */
    protected function postBody()
    {
        return $this->req->getJSON(true);
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


    /**
     * 上传文件，文件将按日期保存，并提供随机ID作为名称
     *
     * @param string $fileName 文件表单名
     * @return array 文件是否上传成功 / 失败原因 / 保存位置
     */
    protected function upload(string $fileName)
    {
        $file = $this->getFile($fileName);
        $saveName = $file->getRandomName();
        $subPath = date('Y/m/d');
        return $this->doUpload($file, $saveName, $subPath);
    }

    /**
     * 执行文件上传及存储
     * @param UploadedFile $file
     * @param string $saveName
     * @param string $subPath
     * @param array $allowedExt
     * @return array 上传结果
     */
    private function doUpload(UploadedFile $file,
                                string $saveName,
                                string $subPath = '',
                                $allowedExt = array())
    {
        if (!$file->isValid()) {
            return array(false, $file->getErrorString());
        }
        $ext = $file->getExtension();
        if (!empty($allowedExt) && !in_array($ext, $allowedExt)) {
            return array(false, '不支持上传该类型的文件');
        }
        $subPath = 'files' . '/' . $subPath;
        $saveName = str_end_with($saveName, $ext) ? $saveName : $saveName . '.' . $ext;

        $savePath = $this->pathUpload . '/' . $subPath;

        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $file->move($savePath, $saveName);
        return array(true, $subPath . '/' . $saveName);
    }


    /**
     * 删除上传的文件
     * @param string $filePath 文件路径
     */
    protected function deleteUploadedFile(string $filePath)
    {
        if (!empty($filePath)) {
            $p = $this->pathUpload . $filePath;
            $f = new File($p);
            if ($f->isFile()) {
                unlink($f->getRealPath());
            }
        }
    }
}