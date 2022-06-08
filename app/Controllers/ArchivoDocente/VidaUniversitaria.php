<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class VidaUniversitaria extends BaseController_ArchivoDocente
{
    public function index($idDocenteCodificado)
    {
        $this->set_idDocente($idDocenteCodificado);

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('vida_universitaria');
        $crud->setSubject('Vida Universitaria', 'Registros de Vida Universitaria');
        $crud->where(['id_docente' => $this->idDocente]);
        $crud->setRelation('id_vida_universitaria_tipo', 'vida_universitaria_tipo', 'nombre_vida_universitaria');
        $crud->fieldType('id_docente', 'hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;
            return $data;
        });
        $crud->setFieldUpload('archivo_digital', 'uploads/vida_universitaria', base_url() . '/uploads/vida_universitaria', $this->uploadValidations);


        $crud->requiredFields(['id_docente', 'id_vida_universitaria_tipo', 'descripcion_vida_universitaria', 'gestion', 'archivo_digital']);

        $unsetColumn=['id_docente'];
        if ($this->ionAuth->inGroup(3)) {
            $unsetColumn[]='estado';
            $crud->unsetFields(['estado']);
        }
        $crud->unsetColumns($unsetColumn);

        $crud->displayAs('id_vida_universitaria_tipo', 'Vida Universitaria');

        $crud->fieldType('gestion', 'dropdown', $this->get_gestion());


        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();

        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Vida Universitaria';

        $output->botonActivo = 'vida-universitaria';
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
