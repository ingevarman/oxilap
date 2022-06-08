<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class Curso extends BaseController_ArchivoDocente
{
    private $ionAuth;
    protected $data = [];

    public function __construct()
    {
        $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
    }
    public function index($idDocenteCodificado)
    {
        $this->set_idDocente($idDocenteCodificado);

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());
        
        $crud->setTable('curso');
        $crud->setSubject('Curso', 'Cursos');
        $crud->where(['id_docente'=>$this->idDocente]);
        $crud->setRelation('id_curso_tipo','curso_tipo','nombre_curso_tipo');
        $crud->columns(['id_curso_tipo', 'institucion', 'nombre_evento', 'carga_horaria', 'fecha_evento']);
        $crud->requiredFields(['id_curso_tipo', 'institucion', 'nombre_evento', 'carga_horaria', 'fecha_evento','archivo_digital']);
        $crud->fieldType('id_docente','hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;        
            return $data;
        });
      
        $crud->setFieldUpload('archivo_digital', 'uploads/cursos', base_url() . '/uploads/cursos',$this->uploadValidations);


        $crud->displayAs('id_curso_tipo','Tipo Curso');

        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();

        
        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Cursos de Actualizacion';

        $output->botonActivo = 'curso';
        $output->rowDocente = $this->get_rowDocente();

        return $this->_output_archivo($output);
    }
}
