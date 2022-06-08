<?php

namespace App\Controllers\Gerente;

use App\Controllers\BaseController;

class Gerente extends BaseController
{
    public function index()
    {
        $this->session->set('menu','gerente');
        return view('Gerente/menu');
    
    }
    public function cliente(){
        $this->session->set('menu','gerente');
       

        $crud = $this->_getGroceryCrudEnterprise();
        //$crud->setCsrfTokenName(csrf_token());
        //$crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('cliente');
        //$crud->setSubject('Client');   //realiza cambio de nombres en general
        //$crud->columns(['nombre','Telefono']);  //muestra solo las columnas que indiques
        //$crud->fields(['nombre','Telefono']);   //permite editar solo las columnas que indiques
        
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
    public function usuario(){
        $this->session->set('menu','gerente');
       

        $crud = $this->_getGroceryCrudEnterprise();
        //$crud->setCsrfTokenName(csrf_token());
        //$crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('groups');
       
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE Usuarios';
        $output->subTituloGrocerycrud = 'Lista de Usuarios';

        return $this->_output_grocerycrud($output);
    }
    public function empleado(){
        $this->session->set('menu','gerente');
       

        $crud = $this->_getGroceryCrudEnterprise();
        //$crud->setCsrfTokenName(csrf_token());
        //$crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('empleado');
       // $crud->setRelation('id','groups','name');
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE EMPLEADOS';
        $output->subTituloGrocerycrud = 'Lista de Empleados';

        return $this->_output_grocerycrud($output);
    }
}
