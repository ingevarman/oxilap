<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignacionModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'asignacion';
    protected $primaryKey           = 'id_asignacion';
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

    public function get_asignacion_acreditacion($idDocente){
        $this->select('gestion, nivel,sigla_asignatura, nombre, paralelo, turno, horas_asignadas, categoria, nombramiento, nombramiento_archivo_digital,evaluacion_nota, evaluacion_archivo_digital');
        $this->join('gestion','asignacion.id_gestion = gestion.id_gestion');
        $this->join('asignatura','asignacion.id_asignatura = asignatura.id_asignatura');
        $this->where(['id_docente'=>$idDocente, 'estado_gestion_acreditacion'=>'ACTIVO']);
        $this->orderBY('gestion','DESC');
        return $this->get();
    }
}
