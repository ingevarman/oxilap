<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class Inicio extends BaseController_ArchivoDocente
{
    protected $data = [];

    
    public function principal()
    {
        
        $this->session->set('menu','archivoDocente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }

    public function index()
    {
        
        $this->session->set('menu','archivoDocente');

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setCsrfTokenName(csrf_token());
        $crud->setCsrfTokenValue(csrf_hash());

        $crud->setTable('vista_docente_gestion_activo');
        $crud->setPrimaryKey('id_docente','vista_docente_gestion_activo');
        $crud->setSubject('Docente', 'Docentes');
        $crud->columns(['ci','expedido','nombre','paterno','materno']);
        $crud->setActionButton('Archivo', 'fa fa-user', function ($row) {
            return site_url('archivo/kardex/'.$this->hashids->encode($row->id_docente));
        }, false);
        $crud->unsetOperations();
        $crud->unsetPrint();
        $crud->unsetExportPdf();
        $output = $crud->render();
        $output->tituloGrocerycrud = 'ARCHIVO DOCENTE';
        $output->subTituloGrocerycrud = 'Docentes';
        
        return $this->_output_grocerycrud($output);
    }

    public function docente($idDocente){
        $docenteModel = model('DocenteModel');
		$this->data['rowDocente'] = $docenteModel->find($idDocente);
		$this->data['botonActivo'] = ' ';
		return view('archivoDocente/archivo', $this->data);

    }

   
}
