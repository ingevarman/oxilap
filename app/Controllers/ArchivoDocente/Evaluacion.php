<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class Evaluacion extends BaseController_ArchivoDocente
{

    protected $data = [];
    
    public function index($idDocenteCodificado)
    {
        $this->set_idDocente($idDocenteCodificado);

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('asignacion');
        $crud->setSubject('Asignacion', 'Asignaciones');
        $crud->where(['id_docente' => $this->idDocente]);
        $crud->defaultOrdering('asignacion.id_gestion', 'DESC');
        $crud->setRelation('id_gestion', 'gestion', 'gestion', ['estado_gestion_acreditacion' => 'ACTIVO']);
        $crud->setRelation('id_asignatura', 'asignatura', 'nombre');
        $crud->fieldType('id_docente', 'hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;
            return $data;
        });

        $columnas = ['id_gestion', 'id_asignatura', 'paralelo', 'turno', 'horas_asignadas', 'categoria', 'nombramiento','nombramiento_archivo_digital'];
        $requiredFields = ['nombramiento_archivo_digital'];
        $crud->setFieldUpload('nombramiento_archivo_digital', 'uploads/evaluaciones', base_url() . '/uploads/evaluaciones', $this->uploadValidations);

        if ($this->ionAuth->inGroup(2)) {
            $columnas[] = 'evaluacion_nota';
            $columnas[] = 'evaluacion_archivo_digital';
            $columnas[] = 'estado';

            $requiredFields[] = 'evaluacion_nota';
            $requiredFields[] = 'evaluacion_archivo_digital';

            $crud->setFieldUpload('evaluacion_archivo_digital', 'uploads/evaluaciones', base_url() . '/uploads/evaluaciones', $this->uploadValidations);
        }

        $crud->columns($columnas);
        $crud->fields($columnas);

        $crud->callbackEditField('id_gestion', function ($fieldValue, $primaryKeyValue, $rowData) {
            $gestionModel = model('GestionModel');
            $rowGestion = $gestionModel->find($fieldValue);
            return '<b>' . $rowGestion->gestion . '</b>';
        });
        $crud->callbackEditField('id_asignatura', function ($fieldValue, $primaryKeyValue, $rowData) {
            $asignaturaModel = model('AsignaturaModel');
            $rowAsignatura = $asignaturaModel->find($fieldValue);
            return '<b>' . $rowAsignatura->nombre . '</b>';
        });
        $crud->callbackEditField('paralelo', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<b>' . $fieldValue . '</b>';
        });
        $crud->callbackEditField('turno', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<b>' . $fieldValue . '</b>';
        });
        $crud->callbackEditField('horas_asignadas', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<b>' . $fieldValue . '</b>';
        });
        $crud->callbackEditField('categoria', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<b>' . $fieldValue . '</b>';
        });
        $crud->callbackEditField('nombramiento', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<b>' . $fieldValue . '</b>';
        });

        $crud->displayAs('id_gestion', 'Gestion');
        $crud->displayAs('id_asignatura', 'Asignatura');


        $crud->requiredFields($requiredFields);



        $crud->unsetAdd();
        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();

        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Evaluaciones';

        $output->botonActivo = 'evaluacion';
        $output->rowDocente = $this->get_rowDocente();

        return $this->_output_archivo($output);
    }
}
