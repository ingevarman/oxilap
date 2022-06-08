<?php

namespace App\Models;

use CodeIgniter\Model;

class TituloModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'titulo';
    protected $primaryKey           = 'id_titulo';
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

    public function get_titulo($idDocente){
        $this->select('nombre_grado_academico, nombre_universidad, grado, descripcion, numero_titulo, date_format(fecha_diploma,"%d-%m-%Y") AS fecha_diploma, procedencia, observaciones, archivo_digital');
        $this->join('universidad','titulo.id_universidad = universidad.id_universidad');
        $this->join('grado_academico','titulo.id_grado_academico = grado_academico.id_grado_academico');
        $this->where(['id_docente'=>$idDocente]);
        $this->orderBy('prioridad_academica');
        return $this->get();
    }
}
