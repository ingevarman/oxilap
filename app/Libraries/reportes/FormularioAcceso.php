<?php

namespace App\Libraries\reportes;

// use setasign\Fpdi;
// use setasign\Fpdi\Tcpdf\Fpdi;

use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;

// class FormularioInscripcion extends exFPDF
class FormularioAcceso extends exfpdf
{
    public function __construct()
    {
        parent::__construct('P', 'mm', 'letter');
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/formularioInscripcion/menbre.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);
        $this->SetLeftMargin(41);
        $this->SetRightMargin(23);
        $this->Ln();
    }

    public function reporte($datosInscripcion,$descargar='I')
    {


        $this->AddPage();
        $this->SetFont('Helvetica', '', 8);
        $this->Ln(25);

        $tipoDocumento = 'FORMULARIO DE ACCESO';
        // $datosInscripcion  = [
        //     'nombre' => 'YESSICA',
        //     'primer_apellido' => 'AGUILAR',
        //     'segundo_apellido' => 'GARCIA',
        //     'ci' => '897656',
        //     'expedido' => 'lp',
        //     'nacimiento_fecha' => '12/09/1987',
        //     'nacionalidad' => 'boliviano',

        //     'nombre_preuniversitario' => 'YESSICA',

        //     //     'tipo' => 'PRUEBA DE SUFICIENCIA',
        //     //     'pago_numero_comprobante' => '34567',
        //     //     'costo' => '200',
        //     //     'pago_fecha' => '12/09/2021',
        //     'numero_asiento' => '34',
        //     'id_inscripcion_preuniversitario' => '1',
        //     'fecha_inscripcion' => '12/08/2021'
        // ];
        $table1 = new easyTable($this, 1, 'font-size:12;font-color:#1C3A6E;font-family:helvetica;align:C{CC}');
        $table1->rowStyle('font-size:20;');
        $table1->easyCell('<b>' . $tipoDocumento . '</b>');
        $table1->printRow();
        $table1->easyCell(utf8_decode($datosInscripcion['nombre_preuniversitario']));
        $table1->printRow();
        $table1->endTable(5);

        $table2 = new easyTable($this, 2, 'width:160;align:R{LL};border-width:0.10;font-color:#fff;bgcolor: #fff; font-color:#1C3A6E;font-size:10;line-height:1;');
        $table2->rowStyle('bgcolor: #f54658 ;font-color:#fff;font-style:B;font-size:11;line-height:1.3;');
        $table2->easyCell('<b>DATOS POSTULANTE</b>', 'colspan:2');
        $table2->printRow();
        $table2->easyCell("<b>Nombre(s): </b>");
        $table2->easyCell(utf8_decode($datosInscripcion['nombre']) . "");
        $table2->printRow();
        $table2->easyCell('<b>Apellido Paterno: </b>', '');
        $table2->easyCell(utf8_decode($datosInscripcion['primer_apellido']));
        $table2->printRow();
        $table2->easyCell("<b>Apellido Materno: </b>");
        $table2->easyCell(utf8_decode($datosInscripcion['segundo_apellido']));
        $table2->printRow();
        $table2->easyCell("<b>CI: </b>");
        $table2->easyCell($datosInscripcion['ci'] . ' ' . $datosInscripcion['expedido']);
        $table2->printRow();
        $table2->easyCell("<b>Fecha Nacimiento: </b>");
        $table2->easyCell($datosInscripcion['nacimiento_fecha']);
        $table2->printRow();
        $table2->endTable(5);

        // $valorQR = $datosInscripcion['id_inscripcion_preuniversitario'] . '|' . $datosInscripcion['ci'] . '|' . $datosInscripcion['numero_asiento'];
        $valorQR = site_url('verificar/acceso/'.$datosInscripcion['id_inscripcion_preuniversitario']);
        $this->Image('http://chart.googleapis.com/chart?chs=60x60&cht=qr&chl=' . $valorQR . '&.png', 130, 105, 50, 50);
        
        $table3 = new easyTable($this, 1,'width:160;align:R{LC}; bgcolor:#fff; border-width:0.10;font-color:#1C3A6E;line-height:1;font-size:10;');
        $table3->rowStyle('bgcolor: #f54658 ;font-color:#fff;font-style:B;font-size:11;line-height:1.3;');
        $table3->easyCell("<b>DATOS DE ACCESO</b>");
        $table3->printRow();     
        $table3->endTable();

        $table7 = new easyTable($this, 1,'width:90;align:L{C};font-size:15;');
        $table7->easyCell('<b>Nro. ASIENTO </b>');
        $table7->printRow();
        $table7->rowStyle('font-style:B;font-size:30;');
        $table7->easyCell($datosInscripcion['numero_asiento']);
        $table7->printRow();
        $table7->endTable(45);

        $nombreCompletoPostulante = utf8_decode($datosInscripcion['primer_apellido'] . ' ' . $datosInscripcion['segundo_apellido'] . ' ' . $datosInscripcion['nombre']);
        $table4 = new easyTable($this, 1, 'width:80; align:C{CCC};border-width:0.2; border-color:#1C3A6E;font-color:#1C3A6E;line-height:1.3;');
        $table4->rowStyle('valign:M; border:T;');
        $table4->easyCell("<b>FIRMA POSTULANTE</b>" . "\n<b>" . $nombreCompletoPostulante . "</b>\n<b>" . $datosInscripcion['ci'] . ' ' . $datosInscripcion['expedido'] . '</b>');
        $table4->printRow();
        $table4->endTable(1);

        $table6 = new easyTable($this, 1, 'width:160;font-color:#1C3A6E;font-size:10;');
        $table6->easyCell('<b>NOTA</b>');
        $table6->printRow();
        $table6->easyCell("El presente formulario debe ser presentado el dia del Examen de Suficiencia, quedando anulado si en el se encontrase modificaciones, alteraciones, enmiendas, raspaduras y correcciones realizadas en el mismo.", 'align:L;');
        $table6->printRow();
        $table6->endTable();

        $x = 39;
        $this->SetFontSize('9');
        $this->SetTextColor(28, 58, 110);
        $this->SetXY($x, 216);
        $this->Cell(20, 10, '63120117');

        $this->SetXY($x, 225);
        $this->Cell(20, 10, 'www.medicinaupea.com');

        $this->SetXY($x, 235);
        $this->Cell(20, 10, 'Medicina UPEA Bolivia La Paz-El Alto');

        $this->Output('formularioDeAcceso.pdf', $descargar);
    }
}
