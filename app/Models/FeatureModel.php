<?php


namespace App\Models;


class FeatureModel extends BaseModel
{


    /**
     * 通过别名获取专题
     * @param string $alias 专题别名
     * @return array 专题记录
     */
    public function getByAlias(string $alias)
    {
        return $this->getLatest('alias', $alias);
    }

}