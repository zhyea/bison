<?php


namespace App\Models;


class CommentModel extends BaseModel
{


    /**
     * 分页查询作品评论信息
     * @param int $workId 作品ID
     * @param int $chapterId 章节ID
     * @param int $offset 偏移量
     * @param int $limit 页面长度
     */
    public function findByWorkAndChapter(int $workId, int $chapterId, int $offset = 0, int $limit = 18)
    {
        $this->asArray()
            ->where('work_id', $workId)
            ->where('chapter_id', $chapterId)
            ->orderBy('heat', 'desc')
            ->orderBy('id', 'desc')
            ->findAll($limit, $offset);
    }


}