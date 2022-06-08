<?php

namespace App\Controllers\ArchivoDocente;

use App\Controllers\BaseController_ArchivoDocente;

class Kardex extends BaseController_ArchivoDocente
{
    protected $data = [];
    protected $kardex = [];

    public function index($idDocenteCodificado = '')
    {
        $this->set_idDocente($idDocenteCodificado);

        $this->set_titulo();
        $this->set_produccionIntelectual();
        $this->set_actividadAcademica();
        $this->set_vidaUniversitaria();
        $this->set_evaluacion();

        $dataKardex = [];
        $dataKardex['kardex'] = $this->kardex;

        $this->data['output'] = view('archivoDocente/kardex/index', $dataKardex);
        $this->data['tituloGrocerycrud'] = 'ARCHIVO DOCENTE';
        $this->data['subTituloGrocerycrud'] = 'Titulos Profecionales';

        $this->data['botonActivo'] = 'kardex';
        $this->data['rowDocente'] = $this->get_rowDocente();
        return view('archivoDocente/archivo', $this->data);
    }


    private function set_titulo()
    {
        $tituloModel = model('TituloModel');
        $rowsTitulo = $tituloModel->get_titulo($this->idDocente);
        $data = [];
        foreach ($rowsTitulo->getResult() as $row) {
            $data[] = [
                'Grado Academico' => $row->nombre_grado_academico,
                'Universidad' => $row->nombre_universidad,
                'Grado' => $row->grado,
                'Nombre Titulo' => $row->descripcion,
                'Nro Titulo' => $row->numero_titulo,
                'Fecha Diploma' => $row->fecha_diploma,
                'Observaciones' => $row->observaciones,
                'Archivo Digital' => $this->link_archivo_digital('titulos', $row->archivo_digital)
            ];
        }
        $this->set_kardex('fa-graduation-cap', 'Titulos Profesionales', $data);
    }

    private function set_produccionIntelectual()
    {
        $produccionIntelectualModel = model('ProduccionIntelectualModel');
        $rows = $produccionIntelectualModel->get_produccion_intelectual($this->idDocente);
        $data = [];
        foreach ($rows->getResult() as $row) {
            $data[] = [
                'Tipo' => $row->nombre_tipo,
                'Titulo' => $row->titulo,
                'Descripcion' => $row->descripcion,
                'Nro Paginas' => $row->numero_paginas,
                'Fecha Lanzamiento' => $row->fecha_lanzamiento,
                'Coautores' => $row->nombres_coautores,
                'Archivo Digital' => $this->link_archivo_digital('produccion_intelectual', $row->archivo_digital),
                'Registro'=>$row->registro_tipo,
                'Nro Registro'=>$row->registro_numero,
                'Archivo Digital Registro'=>$this->link_archivo_digital('produccion_intelectual',$row->registro_archivo_digital)
            ];
        }
        $this->set_kardex('fa-book', 'Produccion Intelectual', $data);
    }
    private function set_actividadAcademica()
    {
        $actividadAcademicaModel = model('ActividadAcademicaModel');
        $rows = $actividadAcademicaModel->get_actividad_academica($this->idDocente);
        $data = [];
        foreach ($rows->getResult() as $row) {
            $data[] = [
                'Tipo Actividad Academica' => $row->nombre_actividad_academica_tipo,
                'Actividad' => $row->nombre_actividad_academica,
                'Gestion' => $row->gestion,
                'Archivo Digital' => $this->link_archivo_digital('actividad_academica', $row->archivo_digital)
            ];
        }
        $this->set_kardex('fa-address-card', 'Actividad Academica', $data);
    }

    private function set_vidaUniversitaria()
    {
        $vidaUniversitariaModel = model('VidaUniversitariaModel');
        $rows = $vidaUniversitariaModel->get_vida_universitaria($this->idDocente);
        $data = [];
        foreach ($rows->getResult() as $row) {
            $data[] = [
                'Tipo Vida Universitaria' => $row->nombre_vida_universitaria,
                'Descripcion' => $row->descripcion_vida_universitaria,
                'Gestion' => $row->gestion,
                'Archivo Digital' => $this->link_archivo_digital('vida_universitaria', $row->archivo_digital)
            ];
        }
        $this->set_kardex('fas fa-university', 'Vida Universitaria', $data);
    }

    // private function set_curso()
    // {
    //     $cursoModel = model('CursoModel');
    //     $rows = $cursoModel->get_curso($this->idDocente);
    //     $data = [];
    //     foreach ($rows->getResult() as $row) {
    //         $data[] = [
    //             'Tipo Curso' => $row->nombre_curso_tipo,
    //             'Institucion' => $row->institucion,
    //             'Nombre Evento' => $row->nombre_evento,
    //             'Carga Horaria' => $row->carga_horaria,
    //             'Fecha  Evento' => $row->fecha_evento,
    //             'Archivo Digital' => $this->link_archivo_digital('cursos', $row->archivo_digital)
    //         ];
    //     }
    //     $this->set_kardex('fa-address-card', 'Cursos Actualizacion', $data);
    // }

    private function set_evaluacion()
    {
        $usuarioArchivo = $this->ionAuth->inGroup(2);
        $asignacionModel = model('AsignacionModel');
        $rows = $asignacionModel->get_asignacion_acreditacion($this->idDocente);
        $data = [];
        foreach ($rows->getResult() as $row) {
            $datos = [
                'Gestion' => $row->gestion,
                'Nivel' => $row->nivel,
                'Sigla' => $row->sigla_asignatura,
                'Asignatura' => $row->nombre,
                'Paralelo - Turno' => $row->paralelo . ' - ' . $row->turno,
                'Hr. Asignadas' => $row->horas_asignadas,
                'Categoria' => $row->categoria,
                'Nombramiento' => $row->nombramiento,
                'Nombramiento Archivo Digital' => $this->link_archivo_digital('evaluaciones', $row->nombramiento_archivo_digital)
            ];
            if($usuarioArchivo){
                $datos['Nota Evaluacion']=$row->evaluacion_nota;
                $datos['Archivo Digital']=$this->link_archivo_digital('evaluaciones', $row->evaluacion_archivo_digital);
            }
            $data[] = $datos;
        }
        $this->set_kardex('fa-check-circle', 'Evaluaciones', $data);
    }



    private function set_kardex($icono, $titulo, $data)
    {
        $this->kardex[] = [
            'icono' => $icono,
            'titulo' => $titulo,
            'data' => $data
        ];
    }

    protected function link_archivo_digital($carpeta, $nombreArchivo)
    {
        $url = '';
        if (empty($nombreArchivo)) {
            $url = '<span class="badge outline-badge-danger">Sin archivo Digital</span>';
        } else {
            $urlArchivo = base_url('uploads/' . $carpeta . '/' . $nombreArchivo);
            $url = '<a href = "' . $urlArchivo . '" class="btn btn-outline-info mb-2 reporte_pdf">';
            $url .= '<i class="fas fa-eye"></i> Ver Archivo';
            $url .= '</a>';
        }

        return $url;
    }
}
