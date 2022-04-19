<?php


namespace App\Controllers\admin;


use App\Services\CommentService;
use CodeIgniter\HTTP\RedirectResponse;

class Comment extends AbstractAdmin
{


    private $commentService;


    /**
     * 构造器.
     */
    public function __construct()
    {
        parent::__construct();
        $this->commentService = new CommentService();
    }


    /**
     * 删除评论
     * @param int $id 评论ID
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->commentService->delete($id);
        return $this->goToConsole();
    }


    /**
     * 审批评论
     * @param int $id 评论ID
     * @return RedirectResponse
     */
    public function approve(int $id): RedirectResponse
    {
        $this->commentService->approve($id);
        return $this->goToConsole();
    }


}