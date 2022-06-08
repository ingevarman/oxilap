<?php

namespace App\Libraries\reportes;

// use setasign\Fpdi;

// use setasign\Fpdi\Tcpdf\Fpdi;

include 'qrcode/qrcode.class.php';

use QRcode;


use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;




// class FormularioInscripcion extends exFPDF
class HojaRespuesta extends exfpdf
{
    public function __construct()
    {
        //216mm x 330mm = Tamaño Oficio
        parent::__construct('P', 'mm', [216, 330]);

        // Establecemos los márgenes izquierda, arriba y derecha:
        // $this->SetMargins(29, 29, 19);
        // Establecemos el margen inferior:
        // $this->SetAutoPageBreak(true, 19);
    }


    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/hojaRespuesta/hoja_respuestas.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);

        $this->SetLeftMargin(16);
        $this->SetRightMargin(15);
    }

    public function reporte($idPreuniversitario, $descargar = 'I')
    {
        $vistaInscripcionModel = model('VistaInscripcionModel');
        $rowsInscripcion = $vistaInscripcionModel->hoja_respuesta($idPreuniversitario);

        $preuniversitarioModel = model('PreuniversitarioModel');
        $rowPreuniversitario = $preuniversitarioModel->find($idPreuniversitario);
        $titulo = $rowPreuniversitario->tipo;
        $titulo.= ' ACADEMICA';
        $gestion = $rowPreuniversitario->gestion;
        $gestion.= empty($rowPreuniversitario->convocatoria)?'':'-'.$rowPreuniversitario->convocatoria;

        foreach ($rowsInscripcion as $row) {

            $nombrePostulante = strtoupper($row->nombre . ' ' . $row->primer_apellido . ' ' . $row->segundo_apellido);
            $numeroCaracteres = strlen($nombrePostulante);
            $fontSizeNombre = 10;
            if ($numeroCaracteres > 32) {
                $fontSizeNombre = 8;
            }
            if ($numeroCaracteres > 40) {
                $fontSizeNombre = 6;
            }
            $ci = $row->ci;
            $numeroAsiento = $row->numero_asiento;
            $idInscripcionPreuniversitario = $row->id_inscripcion_preuniversitario;


            $this->AddPage();

            $this->SetFont('Helvetica', 'B', 14);
            $this->SetY(20);

            $this->Cell(186, 7, $titulo, 0, 1, 'C');
            $this->Cell(186, 7, 'GESTION ' . $gestion, 0, 1, 'C');

            $valorQr  = 'PruSuf-' . $gestion . '|' . $numeroAsiento . '|' . $idInscripcionPreuniversitario . '|' . $ci . '|' . $nombrePostulante;
            $qrcode = new QRcode($valorQr, 'H');
            $qrcode->disableBorder();
            $qrcode->displayFPDF($this, 165, '37', 33);

            $this->SetFont('Helvetica', '', 8);
            $this->Ln(4);

            $table2 = new easyTable($this, '{23,77}', 'width:100;align:L{LL};font-size:10; border:0;');
            $table2->printRow();
            $table2->easyCell("<b>Postulante :</b>");
            $table2->rowStyle('font-size:' . $fontSizeNombre . ';');
            $table2->easyCell(utf8_decode($nombrePostulante));
            $table2->printRow();
            $table2->easyCell('', 'colspan:2');
            $table2->printRow();
            $table2->easyCell("<b>Nro CI :</b>");
            $table2->rowStyle('font-size:14;');
            $table2->easyCell($ci);
            $table2->printRow();
            $table2->endTable(5);

            $x = 34;
            $y = '59.5';

            // Codigo
            $this->SetFontSize('14');
            $this->SetXY($x, $y);
            $this->Cell(32, 10, $idInscripcionPreuniversitario);

            // Asiento
            $this->SetFontSize('20');
            $this->SetXY($x + 51, $y);
            $this->Cell(32, 10, $numeroAsiento);
        }

        $nombreArchivo = 'FormularioInscripcion_gestion_'.$gestion;
        $this->Output($nombreArchivo.'.pdf', $descargar);
    }
}
