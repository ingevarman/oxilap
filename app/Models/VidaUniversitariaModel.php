<?php

namespace App\Models;

use CodeIgniter\Model;

class VidaUniversitariaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'vida_universitaria';
    protected $primaryKey           = 'id_vida_universitaria';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
    
    public function get_vida_universitaria($idDocente){
        $this->select('nombre_vida_universitaria, vida_universitaria.descripcion_vida_universitaria, gestion, archivo_digital');
        $this->join('vida_universitaria_tipo','vida_universitaria.id_vida_universitaria_tipo = vida_universitaria_tipo.id_vida_universitaria_tipo');
        $this->where(['id_docente'=>$idDocente]);
        return $this->get();
    }
}
