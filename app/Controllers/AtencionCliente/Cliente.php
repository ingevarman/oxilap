<?php

namespace App\Controllers\AtencionCliente;

use App\Controllers\BaseController;

class Cliente extends BaseController
{
    public function index()
    {
        $this->session->set('menu','atencionCliente');
        $crud = $this->_getGroceryCrudEnterprise();
        //$crud->setCsrfTokenName(csrf_token());
        //$crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('cliente');
       
        $crud->displayAs('nombre','Nombre(s)');
        $crud->displayAs('ci','Nro de C.I.');
        $crud->displayAs('nit','Nro de NIT');
        $crud->displayAs('telefono','Telefono/Celular');
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE CLIENTES';
        $output->subTituloGrocerycrud = 'Lista de Clientes';

        return $this->_output_grocerycrud($output);
    
    }
}
