<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class ActividadAcademica extends BaseController_ArchivoDocente
{
    public function index($idDocenteCodificado)
    {
        $this->set_idDocente($idDocenteCodificado);

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());
        
        $crud->setTable('actividad_academica');
        $crud->setSubject('Actividad Academica', 'Actividades Academicas');
        $crud->where(['id_docente'=>$this->idDocente]);
        $crud->setRelation('id_actividad_academica_tipo','actividad_academica_tipo','nombre_actividad_academica_tipo');
        $crud->fieldType('id_docente','hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;        
            return $data;
        });
        $crud->setFieldUpload('archivo_digital', 'uploads/actividad_academica', base_url() . '/uploads/actividad_academica',$this->uploadValidations);
        

        $crud->requiredFields(['id_docente', 'id_actividad_academica_tipo', 'nombre_actividad_academica', 'gestion', 'archivo_digital']);
        
        $unsetColumn=['id_docente'];
        if ($this->ionAuth->inGroup(3)) {
            $unsetColumn[]='estado';
            $crud->unsetFields(['estado']);
        }
        $crud->unsetColumns($unsetColumn);

        $crud->displayAs('id_actividad_academica_tipo','Actividad Academica');

        $crud->fieldType('gestion', 'dropdown', $this->get_gestion());
        
        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();

        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Actividad Academica';

        $output->botonActivo = 'actividad-academica';
        $output->rowDocente = $this->get_rowDocente();

        return $this->_output_archivo($output);
    }

    private function get_gestion()
    {
        $gestionModel = model('GestionModel');
        $rowsGestion= $gestionModel->getWhere(['estado_gestion_acreditacion'=>'ACTIVO']);
        $gestion = [];
        foreach($rowsGestion->getResult() AS $row){
            $gestion[$row->gestion] = $row->gestion;

        }
        return $gestion;
    }
}
