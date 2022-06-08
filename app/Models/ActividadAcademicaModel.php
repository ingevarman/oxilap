<?php

namespace App\Models;

use CodeIgniter\Model;

class ActividadAcademicaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'actividad_academica';
    protected $primaryKey           = 'id_actividad_academica';
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

    public function get_actividad_academica($idDocente){
        $this->select('nombre_actividad_academica_tipo, nombre_actividad_academica, gestion, archivo_digital ');
        $this->join('actividad_academica_tipo','actividad_academica.id_actividad_academica_tipo = actividad_academica_tipo.id_actividad_academica_tipo');
        $this->where(['id_docente'=>$idDocente]);
        return $this->get();
    }

}
