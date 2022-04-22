<?php


namespace App\Services;


use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\WorkModel;
use Config\Custom;

class CommentService
{

    private $commentModel;
    private $chapterModel;
    private $workModel;
    private $customConfig;

    /**
     * CommentService constructor.
     */
    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->chapterModel = new ChapterModel();
        $this->workModel = new WorkModel();
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
     * 查找待审批评论
     * @return array 待审批评论
     */
    public function findToApprove(): array
    {
        $comments = $this->commentModel->findToApprove();
        if (empty($comments)) {
            return array();
        }
        foreach ($comments as &$cm) {
            $chapterId = $cm['chapter_id'];
            if (0 != $chapterId) {
                $chapter = $this->chapterModel->getById($chapterId);
                $cm['chapter_name'] = $chapter['name'];
            }
            $workId = $cm['work_id'];
            $work = $this->workModel->getById($workId);
            $cm['work_name'] = $work['name'];
        }
        return $comments;
    }


    /**
     * 删除评论
     * @param int $id 评论ID
     * @return bool 是否完成
     */
    public function delete(int $id): bool
    {
        return $this->commentModel->deleteById($id);
    }


    /**
     * 审批通过评论
     * @param int $id 评论ID
     * @return bool 是否完成
     */
    public function approve(int $id): bool
    {
        return $this->commentModel->approve($id);
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
        $diff = time() - $opTime;
        if ($diff < 60) {
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
        $data['name'] = strip_tags(mb_substr($data['name'], 0, 12));
        $data['content'] = strip_tags(mb_substr($data['content'], 0, 128));
        $workId = $data['work_id'];
        $chapterId = $data['chapter_id'];
        $sign = $data['sign'];
        $data = array_key_rm('sign', $data);
        $data['status'] = 1;
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