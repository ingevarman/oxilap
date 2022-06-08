<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        //dd($arguments);
        $group = $arguments;
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        if (!($ionAuth->loggedIn() && $ionAuth->inGroup($group))) {
            // redirect them to the login page
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
