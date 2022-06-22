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
     * 删除评论,
     * @param int $id 评论ID
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->commentService->delete($id);
        return $this->goToConsole();
    }


    /**
     * 删除评论并跳回评论管理页
     * @param int $id 评论ID
     * @param int $pageNo 评论页码
     */
    public function delete2(int $id, int $pageNo)
    {
        $this->commentService->delete($id);
        $this->list($pageNo);
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


    /**
     * 分页获取评论信息
     * @param int $pageNo 页码
     * @param int $pageSize 页面长度
     */
    public function list(int $pageNo = 1, int $pageSize = 36)
    {
        $data = $this->commentService->findInPage($pageNo, $pageSize);
        $this->adminView('comments', $data, '评论管理');
    }


}