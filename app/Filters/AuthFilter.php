<?php


namespace App\Filters;


use App\Services\RemoteCodeService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class AuthFilter implements FilterInterface
{

    private $session;
    private $rcService;

    /**
     * 构造器.
     */
    public function __construct()
    {
        helper('string');
        $this->session = session();
        $this->rcService = new RemoteCodeService();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $path = $request->getPath();
        if (!str_start_with($path, 'admin')) {
            return;
        }
        $r = $this->checkAuth($request);
        if (null == $r) {
            return;
        }
        redirect($r);
        // TODO: Implement before() method.
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }


    private function checkAuth(RequestInterface $request)
    {
        $failedCount = $this->session->get('failed');
        if (empty($failedCount)) {
            $failedCount = 0;
        }

        $user = $this->session->get('user');
        $code = header('Remote-Code');

        if (!empty($code)) {
            if ($failedCount > 20) {
                error_code(403, 'retry too many times');
            }
            $rc = $this->rcService->validCode($code);
            if (empty($rc)) {
                $this->session->set('failed', $failedCount + 1);
                error_code(403, 'invalid remote code');
            }
            return null;
        }
        if (empty($user)) {
            return 'login';
        }

        $lastLog = $this->session->get('lastLog');
        $diff = (time() - $lastLog) / 60 / 60;
        if ($diff > 1) {
            $this->session->remove('user');
            return 'login';
        }
        $this->session->set('lastLog', time());
        return null;
    }
}