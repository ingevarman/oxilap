<?php

namespace App\Models;

use CodeIgniter\Model;

class DocenteModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'docente';
    protected $primaryKey           = 'id_docente';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['codigo_archivo'];

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

    public function get_docente($idDocente)
    {
        $this->where(['id_docente' => $idDocente]);
        $rowDocente = $this->get()->getRow();
        $codigoArchivo = $rowDocente->codigo_archivo;
        if (empty($codigoArchivo)) {
            $this->selectMax('codigo_archivo', 'max_codigo_archivo');
            $maximoCodigoArchivo = $this->get()->getRow()->max_codigo_archivo + 1;

            $this->update_codigo_archivo($idDocente, $maximoCodigoArchivo);

            $this->where(['id_docente' => $idDocente]);
            $rowDocente = $this->get()->getRow();
        }
        
        return $rowDocente;
    }

    private function update_codigo_archivo($idDocente, $codigoArchivo)
    {
        $this->set('codigo_archivo', $codigoArchivo);
        $this->where(['id_docente' => $idDocente]);
        $this->update();
    }
}
