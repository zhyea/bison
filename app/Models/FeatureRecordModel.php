<?php


namespace App\Models;


use ReflectionException;

class FeatureRecordModel extends BaseModel
{


    /**
     * 根据专题ID统计作品数量
     * @param int $featureId 专题ID
     * @return int 专题作品数量
     */
    public function countWithFeature(int $featureId)
    {
        return $this->countBy(array('feature_id' => $featureId));
    }


    /**
     * 根据专题别名统计作品数量
     * @param string $alias 专题别名
     * @return int 专题作品数量
     */
    public function countWithAlias(string $alias)
    {
        $obj = $this->asObject()
            ->selectCount('feature_record.id', 'cnt')
            ->join('feature', 'feature_record.feature_id=feature.id', 'LEFT')
            ->where('alias', $alias)
            ->first();
        return $obj->cnt;
    }


    /**
     * 调整排序
     * @param int $id 记录ID
     * @param int $step 排序步长
     *
     * @return bool 是否修改成功
     */
    public function changeOrder(int $id, int $step)
    {
        try {
            return $this->update($id, array('sn' => 'sn+' . $step));
        } catch (ReflectionException $e) {
            return false;
        }
    }

}