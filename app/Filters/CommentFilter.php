<?php


namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CommentFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $request->getIPAddress();
        // TODO: Implement before() method.
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}