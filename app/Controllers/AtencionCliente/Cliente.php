<?php

namespace App\Controllers\AtencionCliente;

use App\Controllers\BaseController;
use App\Models\DetalleCompraModel;

class Cliente extends BaseController
{
   

    public function index()
    {
        $this->session->set('menu','atencionCliente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('AtencionCliente/principal', $this->data);
    }
    public function cliente()
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
        $crud->setActionButton('Pedidos', 'fa fa-list', function ($row) {
            return site_url('atencioncliente/registroPedido/'. $row->id_cliente);
        }, FALSE);
        $output = $crud->render();
        //dd($output);
        $output->tituloGrocerycrud = 'REGISTRO DE CLIENTES';
        $output->subTituloGrocerycrud = 'Lista de Clientes';
        return $this->_output_grocerycrud($output);
    }

    public function ubicacionCliente(){
        $this->session->set('menu', 'atencionCliente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('AtencionCliente/registroUbicacionCliente', $this->data);
        
    }
    public function registroPedido_(){
        $this->session->set('menu', 'atencionCliente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('AtencionCliente/registroPedido', $this->data);
    }

    public function registroPedido($idCliente)
    {
        $this->session->set('menu','atencionCliente');
        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());

        $crud->setCsrfTokenValue(csrf_hash());
        $crud->where(['id_cliente'=>$idCliente]);
        $crud->setTable('orden_compra');
        $crud->setActionButton('Ver detalle', 'fa fa-list', function ($row) {
            return site_url('atencioncliente/designarPedido/'. $row->id_orden_compra);
        }, FALSE);
        $output = $crud->render();
        //para llamar en cabezera el usuario segun el modelod e ususario
        //inicio
        $clienteModel = model('ClienteModel');
        $rowCliente = $clienteModel->find($idCliente);
        $nombreCliente = $rowCliente->nombre_cliente.' '.$rowCliente->apellido_paterno.' '.$rowCliente->apellido_materno;
        $output->tituloGrocerycrud = 'Cliente: '.$nombreCliente;
        $output->subTituloGrocerycrud = 'Lista de Pedidos';
        //fin del encabezado
        return $this->_output_grocerycrud($output);
    }

    public function designarPedido($idOrdenCompra)
    {
        $ordenCompraModel = model('OrdenCompraModel');
        $rowOrdenCompra = $ordenCompraModel->find($idOrdenCompra);
        $idCliente = $rowOrdenCompra->id_cliente;
        $this->session->set('menu', 'atencionCliente');
       
        //para obtener datos del clinetee
        $clienteModel = model('ClienteModel');
        $rowCliente = $clienteModel->find($idCliente);
        $nombreCliente = $rowCliente->nombre_cliente.' '.$rowCliente->apellido_paterno.' '.$rowCliente->apellido_materno;
        //para obtener datos del detalle compra
        $detalleCompraModel = model('DetalleCompraModel');
        $rowDetalle = $detalleCompraModel->registroDetalle($idOrdenCompra);
        $sumaDetalle = $detalleCompraModel->sumaDetalle($idCliente);
       //dd($detalleModel->sumaDetalle($idCliente));


        $precioModel = model('PrecioModel');
      //proceso para vista de Oxigeno medicinal Recarga
        $recargaOxigeno = $precioModel->recarga_Oxigeno();
        $recargaProducto = $precioModel->recarga_producto();


        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        $this->data['idOrdenCompra'] = $idOrdenCompra;
        $this->data['idCliente'] = $idCliente;
        $this->data['nombreCliente'] = $nombreCliente;
        $this->data['datos'] = $rowDetalle;
        $this->data['r_suma'] = $sumaDetalle;
   
        $this->data['r_oxigeno'] = $recargaOxigeno;
        $this->data['r_producto'] = $recargaProducto;


        
        return view('AtencionCliente/designarPedido', $this->data);
    }
    

    //funcion para registrar en la tabla orden_compra_detalle
   public function registrarDetalle(){
       //modelo para extraer datos Clientes
    $request =\Config\Services::request();
    $suma='1';
    $detalleModel = model('DetalleCompraModel');
    $rowDetalle = $detalleModel->findAll();
    $sumaDetalle = $detalleModel->sumaDetalle($suma);
   
    $precioModel = model('PrecioModel');
  
    $recargaOxigeno = $precioModel->recarga_Oxigeno();
    $recargaProducto = $precioModel->recarga_producto();
    
    
    $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
    $this->data['n_cliente'] ='1';
    $this->data['Nombre_cliente'] ='Namu';
    $this->data['datos'] = $rowDetalle;
    $this->data['r_oxigeno'] = $recargaOxigeno;
    $this->data['r_producto'] = $recargaProducto;
    $this->data['r_suma'] = $sumaDetalle;
   // $this->data['Nombre_cliente'] = $cliente->nombre_cliente;


   $idOrdenCompra = $this->request->getPost('id_orden_compra');
    $id_orden = $this->request->getPost('id_orden');
    //$id_sucursal = $this->request->getPost('id_sucursal');
    $id_sucursal = 1;
    $id_precio = $this->request->getPost('id_precio');

    $precioProducto = $this->request->getPost('precioProducto');
    $cantidad = $this->request->getPost('cantidad');
    
    $subTotal= $precioProducto * $cantidad;
    //dd($subTotal);
   
  
    $modeloDetalle = new DetalleCompraModel();
   
    $modeloDetalle->insert([
        'id_orden_compra'    => $idOrdenCompra,
        'id_sucursal'        => $id_sucursal,
        'id_precio'          => $id_precio,
        'cantidad'           => $cantidad,
        'sub_total'           => $subTotal
    ]);

    //return view('AtencionCliente/designarPedido',$this->data);
    //exit('entro aqui');
    return redirect()->to(site_url('atencioncliente/designarPedido/'.$idOrdenCompra));
  
   }


}
