<?php


namespace App\Services;


use App\Models\CommentModel;

class CommentService
{

    private $commentModel;

    /**
     * CommentService constructor.
     */
    public function __construct()
    {
        $this->commentModel = new CommentModel();
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
     * 根据IP查询最新的评论信息
     * @param string $ip 请求IP
     * @return array
     */
    public function getByIp(string $ip): array
    {
        return $this->commentModel->getLatestByParams(array('ip' => $ip));
    }


    /**
     * 新增评论
     * @param array $data 评论信息
     * @return bool 是否新增成功
     */
    public function add(array $data): bool
    {
        return $this->commentModel->insertSilent($data);
    }

}