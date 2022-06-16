<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id_producto';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['capacidad', 'unidad', 'tipo_material', 'nombre_producto', 'codigo_producto', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;    

    public function producto_registro($estado){
        $this->select('producto_tipo.nombre_producto_tipo, producto.capacidad, producto.unidad, producto.tipo_material');
        $this->join('producto_tipo','producto_tipo.id_producto_tipo = producto.id_producto_tipo');
        $this->where('producto.estado',$estado);
        return $this->get()->getResult();
    }

    /*public function empleado_cargo($estado){
        $this->select('id_empleado,empleado.nombre,ape_paterno,ape_materno,empleado.id_cargo,turno,empleado.activo,cargo.nombre AS nombre_cargo');
        $this->join('cargo','empleado.id_cargo = cargo.id_cargo');
        $this->where('empleado.activo',$estado);
        return $this->get()->getResult();

    }*/
}


?>