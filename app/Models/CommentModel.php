<?php


namespace App\Models;


class CommentModel extends BaseModel
{


    /**
     * 分页查询作品评论信息
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @param int $pageNum 偏移量
     * @param int $pageSize 页面长度
     * @return array 评论信息
     */
    public function findByWorkAndChapter(int $workId, int $chapterId, int $pageNum = 0, int $pageSize = 36): array
    {
        $offset = ($pageNum - 1) * $pageSize;
        return $this->asArray()
            ->where('work_id', $workId)
            ->where('chapter_id', $chapterId)
            ->where('status', 0)
            ->orderBy('heat', 'desc')
            ->orderBy('id', 'desc')
            ->findAll($pageSize, $offset);
    }


    /**
     * 分页查询评论信息
     * @param int $pageNum
     * @param int $pageSize
     * @return array
     */
    public function findInPage(int $pageNum = 1, int $pageSize = 36): array
    {
        $pageNum = (0 >= $pageNum ? 1 : $pageNum);
        $offset = ($pageNum - 1) * $pageSize;
        return $this->asArray()
            ->orderBy('id', 'desc')
            ->findAll($pageSize, $offset);
    }


    /**
     * 查找待审批评论
     * @return array 评论集合
     */
    public function findToApprove()
    {
        return $this->asArray()
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->findAll(36, 0);
    }


    /**
     * 执行评论审批
     * @param int $id 评论ID
     * @return bool
     */
    public function approve(int $id): bool
    {
        return $this->updateById(array('id' => $id, 'status' => 0));
    }
}