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
     */
    public function findByWorkAndChapter(int $workId, int $chapterId, int $pageNum = 0, int $pageSize = 36): array
    {

        $offset = ($pageNum - 1) * $pageSize;
        return $this->asArray()
            ->where('work_id', $workId)
            ->where('chapter_id', $chapterId)
            ->orderBy('heat', 'desc')
            ->orderBy('id', 'desc')
            ->findAll($pageSize, $offset);
    }


}