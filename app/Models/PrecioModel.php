<?php
namespace App\Models;

use CodeIgniter\Model;

class PrecioModel extends Model
{
    protected $table      = 'precio';
    protected $primaryKey = 'id_precio';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_producto', 'tipo_servicio', 'zona', 'precio','estado','activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_baja';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;    

    public function registro_precios($estado){
        $this->select('producto_tipo.nombre_producto_tipo, producto.capacidad, producto.unidad, producto.tipo_material, precio.zona, precio.precio ');
        $this->join('producto','precio.id_producto = producto.id_producto ');
        $this->join('producto_tipo','producto.id_producto_tipo = producto_tipo.id_producto_tipo');
        $this->where('activo',$estado);
        return $this->get()->getResult();
    }
    public function recarga_Oxigeno(){
        $this->select('precio.id_precio, producto_tipo.nombre_producto_tipo, producto.capacidad, producto.unidad, producto.tipo_material, producto.nombre_producto, precio.zona, precio.precio');
        $this->join('producto','precio.id_producto = producto.id_producto ');
        $this->join('producto_tipo','producto.id_producto_tipo = producto_tipo.id_producto_tipo');
        $this->where(' producto_tipo.nombre_producto_tipo','Oxigeno Medicinal e industrial');
        $this->where('precio.tipo_servicio','RECARGA');
        $this->orderBy('precio.zona');
        return $this->get()->getResult();
    }
    public function recarga_producto(){
        $this->select('producto_tipo.nombre_producto_tipo, producto.capacidad, producto.unidad, producto.tipo_material, producto.nombre_producto, precio.zona, precio.precio');
        $this->join('producto','precio.id_producto = producto.id_producto ');
        $this->join('producto_tipo','producto.id_producto_tipo = producto_tipo.id_producto_tipo');
        //$this->where('producto_tipo.nombre_producto_tipo!','Oxigeno Medicinal e industrial');
       
        $this->where('precio.tipo_servicio','RECARGA');
        return $this->get()->getResult();
    }

}


?>