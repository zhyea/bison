<?php

namespace App\Models;

/**
 * 用户表Model
 * Class UserModel
 * @package App\Models
 */
class UserModel extends BaseModel
{


    /**
     * 检查并获取用户信息
     * @param $username string 用户名
     * @param $password string 密码
     * @return array 用户信息
     */
    public function checkAndGet(string $username, string $password)
    {
        return $this->getLatestByParams(array('username' => $username, 'password' => $password));
    }


    /**
     * 根据用户名获取用户信息
     * @param $username string 用户名
     * @return array 用户信息
     */
    public function getByUsername(string $username)
    {
        return $this->getLatest('username', $username);
    }


}