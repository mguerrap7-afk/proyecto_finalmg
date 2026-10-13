<?php

namespace App\Filters;

use App\Services\AuthService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RememberFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('user_id')) {
            return;
        }

        $cookie = $request->getCookie('remember_me');
        if (! $cookie) {
            return;
        }

        $user = (new AuthService())->userFromRemember($cookie);
        if ($user) {
            session()->set([
                'user_id'   => (int) $user['id'],
                'user_name' => $user['name'],
                'is_admin'  => (int) $user['is_admin'],
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}