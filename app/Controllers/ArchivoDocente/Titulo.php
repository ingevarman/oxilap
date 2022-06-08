<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class Titulo extends BaseController_ArchivoDocente
{
    protected $data = [];

    public function index($idDocenteCodificado='')
    {
        $this->set_idDocente($idDocenteCodificado);
        // $idDocente = $this->hashids->decode($idDocenteCodificado)[0];
        
        ini_set('upload_max_filesize', '30M');
        // $docenteModel = model('DocenteModel');
        // $rowDocente = $docenteModel->find($idDocente);
        // $rowDocente->id_docente = $idDocenteCodificado;

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());
        
        $crud->setTable('titulo');
        $crud->setSubject('Titulo', 'Titulos');
        $crud->where(['id_docente'=>$this->idDocente]);
        $crud->setRelation('id_grado_academico','grado_academico','nombre_grado_academico',[],'prioridad_academica');
        $crud->setRelation('id_universidad','universidad','nombre_universidad');
        $crud->requiredFields(['id_grado_academico', 'id_universidad', 'grado', 'descripcion', 'numero_titulo', 'fecha_diploma', 'archivo_digital']);
        $crud->fieldType('id_docente','hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;        
            return $data;
        });
        $crud->setFieldUpload('archivo_digital', 'uploads/titulos', base_url() . '/uploads/titulos',$this->uploadValidations);

        $unsetColumn=['id_docente','fecha_registro','procedencia'];
        $unsetFields = ['fecha_registro','procedencia'];
        if ($this->ionAuth->inGroup(3)) {
            $unsetColumn[]='estado';
            $unsetFields[]='estado';
        }
        $crud->unsetColumns($unsetColumn);
        $crud->unsetFields($unsetFields);

        $crud->displayAs('id_grado_academico','Grado Academico');
        $crud->displayAs('id_universidad','Universidad');
        $crud->displayAs('descripcion','Nombre Titulo');

        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();
        
        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Titulos Profecionales';

        $output->botonActivo = 'titulo';
        $output->rowDocente = $this->get_rowDocente();

        return $this->_output_archivo($output);
    }
}
