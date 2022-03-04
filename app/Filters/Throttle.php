<?php


namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * 使用 Throttler 类来实现速率限制
 */
class Throttle implements FilterInterface
{

    private $throttler;

    /**
     * Throttle constructor.
     */
    public function __construct()
    {
        $this->throttler = service('throttler');
    }


    public function before(RequestInterface $request, $arguments = null)
    {
        // 在整个站点上将IP地址限制为每秒不超过20个请求
        if ($this->throttler->check($request->getIPAddress(), 20, SECOND) === false) {
            return service('response')->setStatusCode(429);
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}