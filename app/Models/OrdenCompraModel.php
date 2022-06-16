<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenCompraModel extends Model
{
    protected $table          = 'orden_compra';
    protected $primaryKey     = 'id_orden_compra';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields  = ['id_cliente', 'id_cliente_direccion', 'tipo_emision','fecha_orden_compra','factura_numero', 'factura_nombre','factura_nit','total'];

    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;    

  
    
}
