<?php

namespace App\Service;


use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\FeatureModel;
use App\Models\WorkModel;

class SitemapService
{

    private $categoryModel;
    private $featureModel;
    private $authorModel;
    private $workModel;


    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->featureModel = new FeatureModel();
        $this->authorModel = new AuthorModel();
        $this->workModel = new WorkModel();
    }


    public function genSitemap()
    {
        $path = _ROOT_DIR_ . DIRECTORY_SEPARATOR . 'sitemap.xml';
        del_file($path);
        $urls = $this->urls();

        $str = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
</urlset>
XML;

        $xml = simplexml_load_string($str);

        foreach ($urls as $record) {
            $item = $xml->addChild('url');
            if (is_array($record)) {
                foreach ($record as $key => $row) {
                    $item->addChild($key, $row);
                }
            }
        }
        $xml->asXML($path);
    }


    /**
     * 获取全部的sitemap url
     * @return array sitemap url
     */
    private function urls()
    {
        $urls = array();
        $this->genCategoryUrls($urls);
        $this->genFeatureUrls($urls);
        $this->genAuthorUrls($urls);
        $this->genWorkUrls($urls);
        return $urls;
    }


    /**
     * 获取作品连接
     * @param $result array 地图结果
     */
    private function genWorkUrls(array &$result)
    {
        $all = $this->workModel->findFull();
        foreach ($all as $r) {
            $url = site_url() . '/work/' . $r['id'] . '.html';
            $op_time = $r['op_time'];
            $array = array(
                'loc' => $url,
                'lastmod' => $op_time,
                'changefreq' => 'yearly',
                'priority' => 0.8,
            );
            array_push($result, $array);
        }
    }


    /**
     * 获取作者连接
     * @param $result array 地图结果
     */
    private function genAuthorUrls(array &$result)
    {
        $all = $this->authorModel->findFull();
        foreach ($all as $r) {
            $url = site_url() . '/author/' . $r['id'] . '.html';
            $op_time = $r['op_time'];
            $array = array(
                'loc' => $url,
                'lastmod' => $op_time,
                'changefreq' => 'weekly',
                'priority' => 0.8,
            );
            array_push($result, $array);
        }
    }


    /**
     * 获取分类连接
     * @param $result array 地图结果
     */
    private function genCategoryUrls(array &$result)
    {
        $all = $this->categoryModel->findFull();
        foreach ($all as $r) {
            $url = site_url() . '/c/' . $r['slug'] . '.html';
            $op_time = $r['op_time'];
            $array = array(
                'loc' => $url,
                'lastmod' => $op_time,
                'changefreq' => 'daily',
                'priority' => 1.0,
            );
            array_push($result, $array);
        }
    }


    /**
     * 获取专题连接
     * @param $result array 地图结果
     */
    private function genFeatureUrls(array &$result)
    {
        $all = $this->featureModel->findFull();
        foreach ($all as $r) {
            $url = site_url() . '/f/' . $r['alias'] . '.html';
            $op_time = $r['op_time'];
            $array = array(
                'loc' => $url,
                'lastmod' => $op_time,
                'changefreq' => 'weekly',
                'priority' => 1.0,
            );
            array_push($result, $array);
        }
    }


}
