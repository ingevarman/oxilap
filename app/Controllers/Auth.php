<?php

namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
    /**
     * If you want to customize the views,
     *  - copy the ion-auth/Views/auth folder to your Views folder,
     *  - remove comment
     */
    protected $viewsFolder = 'auth';

    public function index()
    {
        if (!$this->ionAuth->loggedIn()) {
            // redirect them to the login page
            return redirect()->to('/auth/login');
        } else {
            $groups = $this->ionAuth->getUsersGroups()->getResult();
            foreach ($groups as $row) {
                return redirect()->to(site_url($row->url));
                exit();
            }

            return redirect()->to('/');
        }
    }

}
