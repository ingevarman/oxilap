<?php

namespace App\Controllers;

use App\Controllers\BaseController;


// use App\Libraries\reportes\ResultadoExamen;
// use App\Libraries\reportes\Ficha;
// use App\Libraries\reportes\HojaRespuesta;

use GroceryCrud\Core\GroceryCrud;
use Hashids\Hashids;


class Administrador extends BaseController
{
    private $data = [];
    public $ionAuth;

    public function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
    }

    public function principal()
    {
        $this->session->set('menu', 'administrador');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }


    public function index()
    {
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }

    public function tipo_producto(){
          

        $crud = $this->_getGroceryCrudEnterprise ();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('producto_tipo');
        $crud->requiredFields(['nombre_producto_tipo']);
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'CONFIGURAR PRODUCTOS';
        $output->subTituloGrocerycrud = 'Lista de Tipos de producto';

        return $this->_output_grocerycrud($output);
    }
    public function producto(){
          

        $crud = $this->_getGroceryCrudEnterprise ();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('producto');
        $crud->setSubject('producto', 'productos');
        $crud->requiredFields(['id_producto_tipo','unidad']);
        $crud->displayAs('id_producto_tipo','Tipo Producto');
        $crud->columns(['id_producto_tipo','capacidad','unidad','tipo_material','nombre_producto']);
        
        
        $crud->setRelation('id_producto_tipo','producto_tipo','{nombre_producto_tipo} - {descripcion_producto_tipo}',[],'id_producto_tipo ASC');
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE PRODUCTOS';
        $output->subTituloGrocerycrud = 'Lista de la Tabla de Productos';

        return $this->_output_grocerycrud($output);
    }

    public function precio(){
          

        $crud = $this->_getGroceryCrudEnterprise ();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('precio');
        $crud->requiredFields(['id_producto','tipo_servicio','precio']);
        $crud->columns([
          'id_producto','tipo_servicio','zona','precio'
        ]);
        $crud->fields([
            'id_producto','tipo_servicio','zona','precio'
          ]);
       $crud->displayAs('id_producto','Produto + descripcion');
        //$crud->setRelation('id_producto','producto','id_producto_tipo',[],'id_producto_tipo');
        $crud->setRelation('id_producto','vista_producto','{nombre_producto_tipo} - {capacidad} - {unidad} - {tipo_material}',[],'id_producto ASC');
        $crud->setPrimaryKey('id_producto','vista_producto');
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE PRECIOS';
        $output->subTituloGrocerycrud = 'Lista de la Tabla de Precios';
        return $this->_output_grocerycrud($output);
    }

   
}
