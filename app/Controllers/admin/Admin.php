<?php

namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Services\UserService;

class Admin extends AbstractAdmin
{

    private $userService;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }


    public function login()
    {
        $this->adminView('login', array(), '请登录');
    }


    public function loginCheck()
    {
        $err = $this->req->getGet('err');
        if (empty($err)) {
            $this->rmSession('alert');
        }
        $first_login_time = $this->sessionOf('firstLog', 0);
        if (0 === $first_login_time) {
            $this->setSession('firstLog', time());
        }
        $count = $this->sessionOf('logCount', 0);
        $this->setSession('logCount', $count + 1);

        $diff = (time() - $first_login_time) / 60;

        if ($diff < 5 && $count >= 5) {
            $this->alertDanger('您在短时间内多次尝试登录，请稍后再试');
            $this->redirect('/login?err=2');
            return;
        } elseif ($diff > 5) {
            $this->setSession('firstLog', time());
            $this->setSession('logCount', 0);
        }

        $username = $this->req->getPost('username');
        $password = $this->req->getPost('password');

        $user = $this->userService->checkLogin($username, $password);
        if (!empty($user)) {
            $this->setSession('lastLog', time());
            $this->setSession('user', $user);
            $this->redirect('/admin');
        } else {
            $this->alertDanger('用户名或密码错误');
            redirect()->back()->with('aa', '123');
            //$this->redirect('/login?err=1');
        }
    }


    public function logout()
    {
        $this->rmSession('user');
        $this->redirect('/login');
    }


    public function index()
    {
        $this->adminView('index', array(), '后台首页');
    }


}