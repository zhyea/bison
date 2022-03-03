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


    public function before(RequestInterface $request, $arguments = null)
    {
        /*$throttler = Services::throttler();

        // 在整个站点上将IP地址限制为每秒不超过20个请求
        if ($throttler->check($request->getIPAddress(), 60, SECOND) === false) {
            return Services::response()->setStatusCode(429);
        }*/
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}