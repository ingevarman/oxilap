<?php

namespace App\Controllers\Caja;

use App\Controllers\BaseController;

class Inicio extends BaseController
{
    protected $data = [];

    public function principal()
    {        
        $this->session->set('menu','caja');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }

    public function index()
    {
        echo 'entro aqui';
    }
}
