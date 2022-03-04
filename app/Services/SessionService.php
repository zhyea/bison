<?php


namespace App\Services;


class SessionService
{

    private $session;

    /**
     * SessionService constructor.
     */
    public function __construct()
    {
        $this->session = session();
    }


    /**
     * 从session中取值
     * @param string $key session key
     * @param mixed $defaultVal 默认值
     * @return mixed session中的值
     */
    public function valueOf(string $key, $defaultVal = '')
    {
        $val = $this->session->get($key);
        return empty($val) ? $defaultVal : $val;
    }


    /**
     * 设置session中的值
     * @param string $key session key
     * @param mixed $val 值
     */
    public function set(string $key, $val)
    {
        $this->session->set($key, $val);
    }

    /**
     * 移除session中的值
     * @param string $key session key
     */
    public function rm(string $key)
    {
        $this->session->remove($key);
    }


}