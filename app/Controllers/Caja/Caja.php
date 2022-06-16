<?php

namespace App\Controllers\Caja;

use App\Controllers\BaseController;

class Caja extends BaseController
{
    public function index()
    {
        $this->session->set('menu','caja');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('Caja/principal', $this->data);
    }
  

    public function registroCaja(){
        $this->session->set('menu', 'caja');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('Caja/registroCaja', $this->data);
        
    }
}
