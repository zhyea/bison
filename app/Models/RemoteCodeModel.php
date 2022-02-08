<?php


namespace App\Models;


class RemoteCodeModel extends BaseModel
{


    /**
     * 根据用户ID获取交互码
     * @param int $userId 用户ID
     * @return array|object|null 交互码相关信息
     */
    public function getByUser(int $userId)
    {
        return $this->getLatest('user_id', $userId);
    }


    /**
     * 根据交互码获取相关信息
     * @param string $code 交互码
     * @return array|object|null 相关信息
     */
    public function getByCode(string $code)
    {
        return $this->getLatest('code', $code);
    }

}