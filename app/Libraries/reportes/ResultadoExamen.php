<?php

namespace App\Libraries\reportes;

// use setasign\Fpdi;
// use setasign\Fpdi\Tcpdf\Fpdi;

use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;

// class FormularioInscripcion extends exFPDF
class ResultadoExamen extends exfpdf
{
    public function __construct()
    {
        parent::__construct('P', 'mm', 'letter');
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/membretado/membrete_carta.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);
        $this->SetLeftMargin(20);
        $this->SetRightMargin(20);
        $this->Ln();
    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print current and total page numbers
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function reporte($idPreuniversitario,$tipoReporte, $descargar = 'I')
    {
        $preuniversitarioModel = model('PreuniversitarioModel');
        $rowPreuniversitario = $preuniversitarioModel->find($idPreuniversitario);
        $titulo = $rowPreuniversitario->tipo;
        $titulo.= ' ACADEMICA ';
        $titulo.= $rowPreuniversitario->gestion;
        $titulo.= empty($rowPreuniversitario->convocatoria)?'':'-'.$rowPreuniversitario->convocatoria;


        $vistaInscripcionModel = model('VistaInscripcionModel');
        if($tipoReporte == 'APROBADOS'){
            $rowsInscripcion = $vistaInscripcionModel->aprobados($idPreuniversitario);    
            
        }
        
        if($tipoReporte == 'REPROBADOS'){
            $rowsInscripcion = $vistaInscripcionModel->reprobados($idPreuniversitario);    
            
        }
        

        $tipoDocumento = 'NOMINA DE '.$tipoReporte;
        $nro = 0;
        
        $contadorFilas = 0;

        foreach ($rowsInscripcion as $row) {
            ++$contadorFilas;
            if ($contadorFilas == 35 || $nro == 0) {
                if ($nro > 0) $table2->endTable(2);


                $contadorFilas = 0;

                $this->AddPage();
                $this->setXY(0,10);
                $this->SetFont('Helvetica', '', 8);
                $this->Ln(10);


                $table1 = new easyTable($this, 1, 'font-size:14;font-color:#1C3A6E;font-family:helvetica;align:C{C}');
                $table1->easyCell('<b> '.$titulo.'</b>');
                $table1->printRow();
                $table1->easyCell('<b>' . $tipoDocumento . '</b>');
                $table1->printRow();
                $table1->endTable(3);

                $table2 = new easyTable($this, '{10,50,20,30}', 'width:160;align:C{RLRC};border:1; border-width:0.10;font-color:#fff;bgcolor: #fff; font-color:#1C3A6E;font-size:10;line-height:1;');
                $table2->rowStyle('bgcolor: #f54658 ;align:{CCCC};font-color:#fff;font-style:B;font-size:11;line-height:1.3;');
                $table2->easyCell('<b>Nro</b>');
                $table2->easyCell('<b>Numero CI</b>');
                $table2->easyCell('<b>Nota</b>');
                $table2->easyCell('<b>Detalle</b>');
                $table2->printRow();
            }

            $table2->easyCell(++$nro);
            $table2->easyCell($row->ci);
            $table2->easyCell(round($row->nota));
            $table2->easyCell($row->detalle);
            $table2->printRow();
        }


        
        // $table2->endTable(2);

        $this->AliasNbPages();

        $nombreArchivo = 'reporte_'.$tipoReporte;

        $this->Output($nombreArchivo.'.pdf', $descargar);
    }
}
