<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class ProduccionIntelectual extends BaseController_ArchivoDocente
{
    protected $data = [];

    public function index($idDocenteCodificado)
    {
        $this->set_idDocente($idDocenteCodificado);

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());
        
        $crud->setTable('produccion_intelectual');
        $crud->setSubject('Produccion Intelectual', 'Producciones Intelectuales');
        $crud->where(['id_docente'=>$this->idDocente]);
        $crud->setRelation('id_produccion_intelectual_tipo','produccion_intelectual_tipo','nombre_tipo');
        $crud->fieldType('id_docente','hidden');
        $crud->callbackAddForm(function ($data) {
            $data['id_docente'] = $this->idDocente;        
            return $data;
        });
        $crud->setFieldUpload('archivo_digital', 'uploads/produccion_intelectual', base_url() . '/uploads/produccion_intelectual',$this->uploadValidations);
        $crud->setFieldUpload('registro_archivo_digital', 'uploads/produccion_intelectual', base_url() . '/uploads/produccion_intelectual',$this->uploadValidations);

        $crud->requiredFields(['id_produccion_intelectual_tipo', 'titulo', 'descripcion', 'numero_paginas', 'fecha_lanzamiento', 'archivo_digital','registro_tipo','registro_numero','registro_archivo_digital']);

        $unsetColumn=['id_docente'];
        if ($this->ionAuth->inGroup(3)) {
            $unsetColumn[]='estado';
            $crud->unsetFields(['estado']);
        }
        $crud->unsetColumns($unsetColumn);
        

        $crud->displayAs('id_produccion_intelectual_tipo','Tipo De Produccion');
        
        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->unsetDelete();
        $crud->unsetFilters();
        $crud->unsetSettings();

        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Produccion Intelectual';

        $output->botonActivo = 'produccion-intelectual';
        $output->rowDocente = $this->get_rowDocente();

        return $this->_output_archivo($output);
    }
}
