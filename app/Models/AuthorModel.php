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


    /**
     * 作者信息维护
     * @param mixed $authorId 作者ID
     * @param string $authorName 作者名称
     * @param string $country 作者国家
     * @return int 作者ID
     */
    public function maintain($authorId, string $authorName, string $country)
    {
        $data = array('name' => $authorName, 'country' => $country);
        if (empty($authorId) || $authorId <= 0) {
            return $this->insertSilent($data);
        } else {
            $data['id'] = $authorId;
            $this->updateById($data);
        }
        return $authorId;
    }

}