<?php

namespace App\Controllers\admin;


use App\Controllers\AbstractController;
use App\Service\UserService;

class AdminController extends AbstractController
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


    public function login_check()
    {
        $first_login_time = from_session('first_log', 0);
        if (0 === $first_login_time) {
            $_SESSION['first_log'] = time();
        }
        $count = from_session('log_count', 0);
        $_SESSION['log_count'] = ($count + 1);

        $diff = (time() - $first_login_time) / 60;

        if ($diff < 5 && $count >= 5) {
            $this->alertDanger('您在短时间内多次尝试登录，请稍后再试');
            $this->redirect('/');
            return;
        } elseif ($diff > 5) {
            $_SESSION['first_log'] = time();
            $_SESSION['log_count'] = 0;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userService->check_login($username, $password);
        if (!empty($user)) {
            $_SESSION['last_log'] = time();
            $_SESSION['user'] = $user;
            $this->redirect('/admin');
        } else {
            $this->alertDanger('用户名或密码错误');
            $this->redirect('/login');
        }
    }


    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('/login');
    }


    public function index()
    {
        $this->adminView('index', array(), '后台首页');
    }


}