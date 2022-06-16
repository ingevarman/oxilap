<?php

namespace App\Controllers\AtencionCliente;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\productoTipoModel;
use App\Models\PrecioModel;
use App\Models\OrdenCompraModel;

class Pedido extends BaseController
{
    protected $productosModel, $preciosModel, $tipoProductoModel, $ordenComprasModel;
   

    public function __construct()
    {
        //$this->unidades = new UnidadesModel();
        $this->productosModel = model('ProductoModel');
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

    


 
}
