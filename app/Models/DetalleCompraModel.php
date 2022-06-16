<?php

namespace App\Models;

use CodeIgniter\Model;

class detalleCompraModel extends Model
{
    protected $table          = 'orden_compra_detalle';
    protected $primaryKey     = 'id_orden_compra_detalle';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields  = ['id_orden_compra', 'id_sucursal', 'id_precio','fecha_recarga','fecha_proxima_recarga', 'cantidad','sub_total'];

    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;    

    public function registroDetalle($idOrdenCompra){
        $this->select('producto_tipo.nombre_producto_tipo, producto.capacidad, producto.unidad, producto.tipo_material, precio.tipo_servicio, precio.zona, precio.precio, orden_compra_detalle.cantidad,orden_compra_detalle.fecha_recarga,orden_compra_detalle.fecha_proxima_recarga, orden_compra_detalle.sub_total');
        $this->join('precio','precio.id_precio= orden_compra_detalle.id_precio');
        $this->join('producto','producto.id_producto = precio.id_producto');
        $this->join('producto_tipo','producto_tipo.id_producto_tipo= producto.id_producto_tipo');
        $this->where('id_orden_compra',$idOrdenCompra);
        return $this->get()->getResult();
    }
    public function sumaDetalle($suma){
        $this->select('id_orden_compra, SUM(sub_total) ');
        $this->where('id_orden_compra',$suma);
        $this->groupBy('id_orden_compra');
        return $this->get()->getResult();
    }
    
}
