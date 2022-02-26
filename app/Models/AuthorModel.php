<?php


namespace App\Models;


class AuthorModel extends BaseModel
{


    /**
     * 查询作者相关的内容
     * @param string $keywords 关键字
     * @return array 查询结果
     */
    public function suggest(string $keywords): array
    {
        return $this->asArray()
            ->like('name', $keywords)
            ->orLike('country', $keywords)
            ->orderBy('id', 'desc')
            ->findAll(9);
    }

}