<?php

namespace App\Controllers\AtencionCliente;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\productoTipoModel;
use App\Models\PrecioModel;
use App\Models\OrdenCompraModel;

class Producto extends BaseController
{
    protected $productos, $preciosModel, $tipoProductoModel, $ordenComprasModel;
   

    public function __construct()
    {
        //$this->unidades = new UnidadesModel();
        $this->producto = model('ProductoModel');
        $this->preciosModel = model('PrecioModel');
        $this->tipoProductoModel = model('productoTipoModel');
        $this->ordenComprasModel = model('OrdenCompraModel');
        helper(['form']);
    }
 

    public function index()
    {
        $this->session->set('menu','atencionCliente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('AtencionCliente/principal', $this->data);
    }


    public function vistaPedidos($activo = 1){
        $this->session->set('menu', 'atencionCliente');
        
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
 
        return view('atencioncliente/registroPedido', $this->data);
    }
    public function buscarPorCodigo($codigo){

        $this->session->set('menu', 'atencionCliente');
        
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();

       $this->preciosModel->select('*');
       $this->preciosModel->where('id_precio',$codigo);
       $this->preciosModel->where('activo',1);
       $datos = $this->precioModel->get()->getRow();

       $existe = false;
       $res['datos']='';
       $res['error']= '';

       if($datos){
        $res['datos'] = $datos;
        $res['existe'] = true;
       }else{
        $res['error'] ='No existe el producto';
        $res['existe'] = false;
       }
       echo json_encode($res);
    }
     
}
