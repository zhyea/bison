<?php


namespace App\Services;


use App\Models\CommentModel;
use Config\Custom;

class CommentService
{

    private $commentModel;

    private $customConfig;

    /**
     * CommentService constructor.
     */
    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->customConfig = new Custom();
    }


    /**
     * 获取作品评论
     * @param int $workId 作品ID
     * @param int $pageNum 页码
     * @param int $pageSize 每页长度
     * @return array 数据
     */
    public function findWorkComments(int $workId, int $pageNum = 1, int $pageSize = 36): array
    {
        return $this->commentModel->findByWorkAndChapter($workId, 0, $pageNum, $pageSize);
    }


    /**
     * 获取作品章节评论
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @param int $pageNum 页码数
     * @param int $pageSize 页面长度
     * @return array 评论信息
     */
    public function findChapterComments(int $workId, int $chapterId, int $pageNum = 1, int $pageSize = 36): array
    {
        return $this->commentModel->findByWorkAndChapter($workId, $chapterId, $pageNum, $pageSize);
    }


    /**
     * 根据IP查询检查最近的评论信息
     * @param string $ip 请求IP
     * @return bool 是否频繁
     */
    public function checkByIp(string $ip): bool
    {
        $cm = $this->commentModel->getLatestByParams(array('ip' => $ip));
        if (empty($cm)) {
            return true;
        }
        $opTime = strtotime($cm['op_time']);
        $now = strtotime(date("y-m-d h:i:s"));
        if ($now - $opTime < 30) {
            return false;
        }
        return true;
    }


    /**
     * 新增评论
     * @param array $data 评论信息
     * @return bool 是否新增成功
     */
    public function add(array $data): bool
    {
        $workId = $data['work_id'];
        $chapterId = $data['chapter_id'];
        $sign = $data['sign'];
        $data = array_key_rm('sign', $data);
        $r = $this->checkSign($workId, $chapterId, $sign);
        if (!$r) {
            return false;
        }
        return $this->commentModel->insertSilent($data);
    }


    /**
     * 检查评论签名
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @param string $sign 评论签名
     * @return bool 签名是否准确
     */
    public function checkSign(int $workId, int $chapterId, string $sign): bool
    {
        $s = $this->signOf($workId, $chapterId);
        return strcmp($sign, $s) == 0;
    }


    /**
     * 创建评论签名
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @return string 签名
     */
    public function signOf(int $workId, int $chapterId): string
    {
        $str = $workId . ':' . $this->customConfig->commentSalt . ':' . $chapterId;
        return md5($str);
    }

}