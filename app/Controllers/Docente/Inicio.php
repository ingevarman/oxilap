<?php

namespace App\Controllers\Docente;

//use App\Controllers\BaseController;
use App\Controllers\BaseController_ArchivoDocente;

class Inicio extends BaseController_ArchivoDocente
{
    protected $data = [];

    
    public function index()
    {
        
        $this->session->set('menu', 'docente');
        $ci = $this->ionAuth->user()->row()->username;
        $docenteModel = model('DocenteModel');
        $idDocente = $docenteModel->getWhere(['ci'=>$ci])->getRow()->id_docente;
        return redirect()->to('/archivo/kardex/'.$this->hashids->encode($idDocente));
    }
    public function principal()
    {
        $this->session->set('menu', 'docente');
        $this->data['groups'] = $this->ionAuth->getUsersGroups()->getResult();
        return view('inicio', $this->data);
    }
}
