<?php


namespace App\Services;


use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\FeatureModel;
use App\Models\FeatureRecordModel;
use App\Models\WorkModel;

class WorkService extends BaseService
{

    private $workModel;
    private $authorModel;
    private $catModel;
    private $recordModel;
    private $featureModel;

    /**
     * 构造器
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->authorModel = new AuthorModel();
        $this->catModel = new CategoryModel();
        $this->recordModel = new FeatureRecordModel();
        $this->featureModel = new FeatureModel();
    }


    /**
     * 首页作品列表
     */
    public function homeWorks(): array
    {
        $all = array();
        $cats = $this->catModel->all();
        foreach ($cats as $c) {
            $works = $this->workModel->findWithCat($c['id'], 'id', 'desc', 0, 18);
            if (!empty($works)) {
                $c['works'] = $works;
                array_push($all, $c);
            }
        }
        $recommend = $this->workModel->findWithFeature('recommend');
        return array('all' => $all, 'recommend' => $recommend);
    }


    /**
     * 分页查询作品信息
     * @param array $con 查询条件
     * @return array 查询结果
     */
    public function findWorks(array $con): array
    {
        $search = '%' . $con['search'] . '%';
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->findWorks($search, $sort, $order, $offset, $limit);
        $total = $this->workModel->countWorks($search);
        return array('total' => $total, 'rows' => $rows);
    }


    /**
     * 根据ID获取作品信息
     * @param int $id 记录ID
     * @return array 记录信息
     */
    public function get(int $id): array
    {
        if ($id <= 0) {
            return array();
        }
        $work = $this->workModel->getById($id);
        if (empty($work)) {
            return array();
        }
        $author = $this->authorModel->getById($work['author_id']);
        if (!empty($author)) {
            $work['author'] = $author['name'];
            $work['country'] = $author['country'];
        }
        $cat = $this->catModel->getById($work['category_id']);
        if (!empty($cat)) {
            $work['cat'] = $cat['name'];
        }
        return $work;
    }


    /**
     * 根据ID获取作品信息
     * @param int $id 作品ID
     * @return array 作品信息
     */
    public function getWork(int $id): array
    {
        return $this->workModel->getWork($id);
    }


    /**
     * 获取分类作品信息
     * @param string $catSlug 分类缩略名
     * @param int $page 页码
     * @return array 结果
     */
    public function findWithCat(string $catSlug, int $page): array
    {
        $cat = $this->catModel->getBySlug($catSlug);
        if (empty($cat)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $works = $this->workModel->findWithCat($cat['id'], $sort, $order, $offset, $length);
        $total = $this->workModel->countWithCat($cat['id']);
        $total = ceil($total / $length);
        $recommend = $this->workModel->findWithFeature('recommend');
        return array('cat' => $cat,
            'keywords' => $cat['name'],
            'description' => $cat['remark'],
            'works' => $works,
            'recommend' => $recommend,
            'page' => $page,
            'total' => $total,
            '_title' => $cat['name']);
    }


    /**
     * 分页获取专题作品信息
     * @param string $featureAlias 专题别名
     * @param int $page 页数
     * @return array 作者作品信息
     */
    public function findWithFeature(string $featureAlias, int $page): array
    {
        $f = $this->featureModel->getByAlias($featureAlias);
        if (empty($f)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $rows = $this->workModel->findWithFeature($featureAlias, $sort, $order, $offset, $length);
        $total = $this->recordModel->countWithAlias($featureAlias);
        $total = ceil($total / $length);
        $data = array('feature' => $f,
            'keywords' => $f['name'],
            'description' => $f['brief'],
            'works' => $rows,
            'page' => $page,
            'total' => $total,
            '_title' => $f['name']);
        if (!empty($f['background'])) {
            $data['background'] = $f['background'];
        }
        if (!empty($f['bg_repeat'])) {
            $data['bg_repeat'] = $f['bg_repeat'];
        }
        if (!empty($f['cover'])) {
            $data['logo'] = $f['cover'];
        }
        return $data;
    }


    /**
     * 分页获取作者作品信息
     * @param int $authorId 作者ID
     * @param int $page 页数
     * @return array 作者作品信息
     */
    public function findWithAuthor(int $authorId, int $page): array
    {
        $author = $this->authorModel->getById($authorId);
        if (empty($author)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $rows = $this->workModel->findWithAuthor($authorId, $sort, $order, $offset, $length);
        $total = $this->workModel->countWithAuthor($authorId);
        $total = ceil($total / $length);
        return array('author' => $author,
            'keywords' => $author['name'],
            'description' => $author['bio'],
            'works' => $rows,
            'page' => $page,
            'total' => $total,
            '_title' => $author['name']);
    }


    /**
     * 分页获取作者作品信息
     * @param int $authorId 作者ID
     * @param array $con 条件集合
     * @return array 作者作品信息
     */
    public function findWithAuthorCon(int $authorId, array $con): array
    {
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->findWithAuthor($authorId, $sort, $order, $offset, $limit);
        $total = $this->workModel->countWithAuthor($authorId);
        return array('total' => $total, 'rows' => $rows);
    }


    /**
     * 分页获取专题作品信息
     * @param string $featureAlias 专题别名
     * @param array $con 条件集合
     * @return array 作者作品信息
     */
    public function findWithFeatureCon(string $featureAlias, array $con): array
    {
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->findWithFeature($featureAlias, $sort, $order, $offset, $limit);
        $total = $this->recordModel->countWithAlias($featureAlias);
        return array('total' => $total, 'rows' => $rows);
    }

    /**
     * 根据关键字查询作品信息
     * @param string $keywords 关键字
     * @return array 作品集合
     */
    public function findWithKeywords(string $keywords): array
    {
        $keywords = empty($keywords) ? '' : $keywords;
        return $this->workModel->findWorks($keywords);
    }


    /**
     * 获取相关作品
     * @param int $workId 作品ID
     * @param int $authorId 作者ID
     * @return array 相关作品
     */
    public function relate(int $workId, int $authorId): array
    {
        $works = $this->workModel->findWithAuthor($authorId);
        $result = array();
        foreach ($works as $w) {
            if ($workId == $w['id']) {
                continue;
            }
            array_push($result, $w);
        }
        return $result;
    }


    /**
     * 根据作品名称获取作品信息
     * @param string $name 作品名称
     * @return array|null 作品信息
     */
    public function getByName(string $name): ?array
    {
        if (empty($name)) {
            return null;
        }
        return $this->workModel->getByName($name);
    }


    /**
     * 增加作品排序
     * @param int $workId 作品ID
     */
    public function addSn(int $workId)
    {
        $this->workModel->addSn($workId);
    }

}