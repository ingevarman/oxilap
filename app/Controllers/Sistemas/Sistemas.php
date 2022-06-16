<?php

namespace App\Controllers\Sistemas;

use App\Controllers\BaseController;

class Sistemas extends BaseController
{
    public function index()
    {
        $this->session->set('menu','sistemas');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('AtencionCliente/principal', $this->data);
    }
    
    public function registroUsario()
    {
        $this->session->set('menu','sistemas');
        $crud = $this->_getGroceryCrudEnterprise();
        //$crud->setCsrfTokenName(csrf_token());
        //$crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('users');
     
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE ROLES';
        $output->subTituloGrocerycrud = 'Lista de Roles';
        return $this->_output_grocerycrud($output);
    }
}
