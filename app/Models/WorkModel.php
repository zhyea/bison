<?php


namespace App\Models;


use ReflectionException;

class WorkModel extends BaseModel
{


    /**
     * 修改分类
     * @param int $oldCat 原分类ID
     * @param int $newCat 新分类ID
     * @return bool 更新数量
     */
    public function changeCategory(int $oldCat, int $newCat): bool
    {
        try {
            return $this->protect(false)
                ->where('category_id', $oldCat)
                ->set('category_id', $newCat)
                ->update();
        } catch (ReflectionException $e) {
            return false;
        }
    }


    /**
     * 获取作品信息
     * @param int $workId 作品ID
     * @return array|object|null 作品信息
     */
    public function getWork(int $workId)
    {
        return $this->asArray()
            ->select(array('w.id', 'w.name', 'w.cover', 'w.brief', 'a.name as author', 'a.id as author_id', 'c.name as cat', 'c.slug as cat_slug'))
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->where('w.id', $workId)
            ->orderBy('w.id', 'DESC')
            ->limit(1)
            ->first();
    }


    /**
     * 查找作品
     * @param string $search 搜索词
     * @param string $sort 排序字段
     * @param string $order 排序方向
     * @param int $offset 偏移量
     * @param int $limit 步长
     * @return array 作品列表
     */
    public function findWorks(string $search,
                              string $sort = 'w.id',
                              string $order = 'DESC',
                              int $offset = 0,
                              int $limit = 18): array
    {
        return $this->asArray()
            ->select(array('w.id', 'w.name', 'w.cover', 'w.brief', 'a.name as author', 'a.id as author_id', 'c.name as cat', 'c.slug as cat_slug'))
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->like('w.name', $search)
            ->orLike('w.brief', $search)
            ->orLike('a.name', $search)
            ->orLike('c.name', $search)
            ->orderBy($sort, $order)
            ->findAll($limit, $offset);
    }


    /**
     * 统计作品匹配到关键词的作品总数
     * @param string $search 关键词
     * @return int 作品总数
     */
    public function countWorks(string $search): int
    {
        $obj = $this->asObject()
            ->selectCount('count(w.id) as cnt')
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->like('w.name', $search)
            ->orLike('w.brief', $search)
            ->orLike('a.name', $search)
            ->orLike('c.name', $search)
            ->first();
        return $obj->cnt;
    }


    /**
     * 查找作者的全部作品
     * @param int $authorId 作者ID
     * @param string $sort 排序字段
     * @param string $order 排序方向
     * @param int $offset 偏移量
     * @param int $limit 步长
     * @return array 作品列表
     */
    public function findWithAuthor(int $authorId,
                                   string $sort = 'w.id',
                                   string $order = 'DESC',
                                   int $offset = 0,
                                   int $limit = 18): array
    {
        return $this->asArray()
            ->select(array('w.id', 'w.name', 'w.cover', 'w.brief', 'a.name as author', 'a.id as author_id', 'c.name as cat', 'c.slug as cat_slug'))
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->where('w.author_id', $authorId)
            ->orderBy($sort, $order)
            ->findAll($limit, $offset);
    }


    /**
     * 统计作者的作品总数
     * @param int $authorId 作者ID
     * @return int 作品总数
     */
    public function countWithAuthor(int $authorId): int
    {
        $obj = $this->asObject()
            ->selectCount('count(w.id) as cnt')
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->where('w.author_id', $authorId)
            ->first();
        return $obj->cnt;
    }


    /**
     * 查找指定专题下的全部作品
     * @param string $featureAlias 专题别名
     * @param string $sort 排序字段
     * @param string $order 排序方向
     * @param int $offset 偏移量
     * @param int $limit 步长
     * @return array 作品列表
     */
    public function findWithFeature(string $featureAlias,
                                    string $sort = 'w.id',
                                    string $order = 'DESC',
                                    int $offset = 0,
                                    int $limit = 18): array
    {
        return $this->asArray()
            ->select(array('w.id', 'w.name', 'w.cover', 'w.brief', 'a.name as author', 'a.id as author_id', 'r.id as record_id'))
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('feature_record as r', 'w.id=r.work_id', 'RIGHT')
            ->join('feature as f', 'r.feature_id=f.id', 'LEFT')
            ->where('f.alias', $featureAlias)
            ->orderBy($sort, $order)
            ->findAll($limit, $offset);
    }


    /**
     * 查询分类下的作品信息
     * @param int $catId 分类ID
     * @param string $sort 排序字段
     * @param string $order 排序方向
     * @param int $offset 偏移量
     * @param int $limit 步长
     * @return array 分类下的作品信息
     */
    public function findWithCat(int $catId,
                                string $sort = 'w.id',
                                string $order = 'DESC',
                                int $offset = 0,
                                int $limit = 18): array
    {
        return $this->asArray()
            ->select(array('w.id', 'w.name', 'w.cover', 'w.brief', 'a.name as author', 'a.id as author_id', 'c.name as cat'))
            ->from('work as w')
            ->join('author as a', 'w.author_id=a.id', 'LEFT')
            ->join('category as c', 'w.category_id=c.id', 'LEFT')
            ->where('w.category_id', $catId)
            ->orderBy($sort, $order)
            ->findAll($limit, $offset);
    }


    /**
     * 统计分类下的作品总数
     * @param int $catId 分类ID
     * @return int 分类下的作品总数
     */
    public function countWithCat(int $catId): int
    {
        return $this->countBy(array('category_id' => $catId));
    }


    /**
     * 根据作品名称查询作品信息
     * @param string $name 作品名称
     * @return array|object|null 作品信息
     */
    public function getByName(string $name)
    {
        return $this->getLatest('name', $name);
    }


    /**
     * 更新作品排序
     * @param int $workId 作品ID
     * @return bool 是否更新成功
     */
    public function addSn(int $workId): bool
    {
        try {
            return $this->update($workId, array('sn' => 'sn+1'));
        } catch (ReflectionException $e) {
            return false;
        }
    }

}