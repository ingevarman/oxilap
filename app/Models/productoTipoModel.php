<?php
namespace App\Models;

use CodeIgniter\Model;

class productoTipoModel extends Model
{
    protected $table      = 'producto_tipo';
    protected $primaryKey = 'id_producto_tipo';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nombre_producto_tipo', 'descripcion_producto_tipo','activo'];

    protected $useTimestamps = true;

    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;    

    public function registro_tipo($estado){
        $this->select('producto_tipo.nombre_producto_tipo ');
        $this->where('activo',$estado);
        return $this->get()->getResult();
    }

}


?>