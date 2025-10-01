<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('isLoggedIn')) {
            // Debug: log session to see what is happening
            log_message('debug', 'AuthGuard check failed. Session: ' . print_r(session()->get(), true));

            return redirect()->to('/login'); 
        }
        // if logged in, do nothing, then request continues
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}
