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


    public function findWorkComments(int $workId, int $pageNum = 1, int $pageSize = 18)
    {
        $offset = ($pageNum - 1) * $pageSize;
        return $this->commentModel->findByWorkAndChapter($workId, 0, $offset, $pageSize);
    }

}