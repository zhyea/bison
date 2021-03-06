<?php

namespace App\Controllers\admin;


use App\Services\CommentService;
use App\Services\UserService;
use CodeIgniter\HTTP\RedirectResponse;

class Admin extends AbstractAdmin
{

    private $userService;
    private $commentService;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
        $this->commentService = new CommentService();
    }


    /**
     * 打开后台首页
     */
    public function index()
    {
        $comments = $this->commentService->findToApprove();
        $this->adminView('index', array('comments' => $comments), '后台首页');
    }


    /**
     * 打开登录页
     */
    public function login()
    {
        $this->adminView('login', array(), '请登录');
    }


    /**
     * 登录信息检查
     * @return RedirectResponse
     */
    public function loginCheck(): RedirectResponse
    {
        $err = $this->getParam('err');
        if (empty($err)) {
            $this->rmSession('alert');
        }
        $lastLoginTime = $this->sessionOf('lastLog', 0);
        if (0 === $lastLoginTime) {
            $this->setSession('firstLogin', time());
        }
        $count = $this->sessionOf('logCount', 0);
        $this->setSession('logCount', $count + 1);

        $diff = (time() - $lastLoginTime) / 60;

        if ($diff < 10 && $count >= 5) {
            $this->alertDanger('失败次数过多，请稍后再试');
            return $this->redirect('/login?err=2');
        } elseif ($diff > 5) {
            $this->setSession('lastLog', time());
            $this->setSession('logCount', 0);
        }

        $username = $this->postParam('username');
        $password = $this->postParam('password');

        $user = $this->userService->checkLogin($username, $password);
        if (empty($user)) {
            $this->alertDanger('用户名或密码错误');
            return $this->redirect('/login?err=1');
        }
        $this->setSession('lastLog', time());
        $this->setSession('user', $user);
        return $this->redirect('/admin/console');
    }


    /**
     * 登出系统
     */
    public function logout()
    {
        $this->rmSession('user');
        $this->rmSession('lastLog');
        $this->rmSession('logCount');
        $this->rmSession('firstLogin');
        return $this->redirect('/login');
    }


}