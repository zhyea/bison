<?php


namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Custom;

class PseudoStatic implements FilterInterface
{

    private $suffix;


    public function __construct()
    {
        $bisonCfg = new Custom();
        $this->suffix = $bisonCfg->suffix;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $path = $request->getPath();
       /* $len = strlen($path) - strlen($this->suffix);
        $path = substr($path, 0, $len);*/
        echo $path;
        //$request->setPath($path);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}