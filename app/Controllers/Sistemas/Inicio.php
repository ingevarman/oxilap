<?php

namespace App\Controllers\Sistemas;

use App\Controllers\BaseController;

class Inicio extends BaseController
{
    protected $data = [];

    public function principal()
    {        
        $this->session->set('menu','sistemas');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }

    public function index()
    {
        echo 'entro aqui';
    }
}
