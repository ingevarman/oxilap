<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'curso';
    protected $primaryKey           = 'id_curso';
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

    public function get_curso($idDocente){
        $this->select('nombre_curso_tipo, institucion, nombre_evento, carga_horaria, date_format(fecha_evento,"%d-%m-%Y") AS fecha_evento, archivo_digital');
        $this->join('curso_tipo','curso.id_curso_tipo = curso_tipo.id_curso_tipo');
        $this->where(['id_docente'=>$idDocente]);
        return $this->get();
    }
}
