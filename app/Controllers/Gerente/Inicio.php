<?php

namespace App\Controllers\Gerente;

use App\Controllers\BaseController;

class Inicio extends BaseController
{
    protected $data = [];

    public function principal()
    {        
        $this->session->set('menu','gerente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('Gerente/menu', $this->data);
    }

    public function index()
    {
        echo 'entro aqui';
    }
}
