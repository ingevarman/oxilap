<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduccionIntelectualModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'produccion_intelectual';
    protected $primaryKey           = 'id_producion_intelectual';
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

    public function get_produccion_intelectual($idDocente){
        $this->select('nombre_tipo,titulo, descripcion, numero_paginas, date_format(fecha_lanzamiento,"%d-%m-%Y") AS fecha_lanzamiento, nombres_coautores, archivo_digital, registro_tipo, registro_numero, registro_archivo_digital');
        $this->join('produccion_intelectual_tipo','produccion_intelectual.id_produccion_intelectual_tipo = produccion_intelectual_tipo.id_produccion_intelectual_tipo');
        $this->where(['id_docente'=>$idDocente]);
        return $this->get();
    }
}
