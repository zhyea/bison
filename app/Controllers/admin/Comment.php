<?php


namespace App\Controllers\admin;


use App\Services\CommentService;

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






}