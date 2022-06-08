<?php

namespace App\Libraries\reportes;

// use setasign\Fpdi;

// use setasign\Fpdi\Tcpdf\Fpdi;


use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;




// class FormularioInscripcion extends exFPDF
class FormularioInscripcion extends exfpdf
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
        $this->SetLeftMargin(20);
        $this->SetRightMargin(15);
        $this->Ln();
    }

    public function reporte($datosInscripcion)
    {

        
        $this->AddPage();
        $this->SetFont('Helvetica', '', 8);
        $this->Ln(25);
  
        $tipoDocumento = 'FORMULARIO DE INSCRIPCION';
        // $datosInscripcion  = [
        //     'nombre' => 'YESSICA',
        //     'primer_apellido' => 'AGUILAR',
        //     'segundo_apellido' => 'GARCIA',
        //     'ci' => '897656',
        //     'expedido' => 'lp',
        //     'nacimiento_fecha' => '12/09/1987',
        //     'nacionalidad' => 'boliviano',
        //     'telefono' => '232323',
        //     'direccion' => 'villa mercedess',

        //     'tipo' => 'PRUEBA DE SUFICIENCIA',
        //     'pago_numero_comprobante' => '34567',
        //     'costo' => '200',
        //     'pago_fecha' => '12/09/2021',
        //     'numero_asiento' => '34',
        //     'fecha_inscripcion'=>'18/10/2021'

        // ];

        // $fechaInscripcion = '12/08/2021';

        $table1 = new easyTable($this, 1,'font-size:12;font-color:#1C3A6E;font-family:helvetica;align:C{CC}');
        $table1->rowStyle('font-size:15;');
        $table1->easyCell('<b>' . $tipoDocumento. '</b>');
        $table1->printRow();
        $table1->easyCell(utf8_decode($datosInscripcion['nombre_preuniversitario']) );
        $table1->printRow();
        $table1->endTable(5);

        $table2 = new easyTable($this, 2, 'width:160;align:R{LL};border-width:0.10;font-color:#fff;bgcolor: #fff; font-color:#1C3A6E;font-size:10;line-height:1;');
        $table2->rowStyle('bgcolor: #f54658 ;font-color:#fff;font-style:B;font-size:11;line-height:1.3;');
        $table2->easyCell('<b>DATOS PERSONALES</b>', 'colspan:2');
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
        $table2->easyCell("<b>Nacionalidad: </b>");
        $table2->easyCell($datosInscripcion['nacionalidad']);
        $table2->printRow();
        $table2->easyCell("<b>Telefono/Celular: </b>");
        $table2->easyCell($datosInscripcion['telefono']);
        $table2->printRow();
        
        $table2->endTable(5);

        $table2 = new easyTable($this,2, 'width:160;align:R{LL}; bgcolor:#fff; border-width:0.10;font-color:#1C3A6E;line-height:1;font-size:10;');
        $table2->rowStyle('bgcolor: #f54658 ;font-color:#fff;font-style:B;font-size:11;line-height:1.3;');
        $table2->easyCell("<b>DATOS DEPOSITO</b>", 'colspan:2');
        $table2->printRow();
        $table2->easyCell('<b>Nro. Deposito: </b>');
        $table2->easyCell($datosInscripcion['pago_numero_comprobante']);
        $table2->printRow();
        $table2->easyCell("<b>Monto BS.: </b>");
        $table2->easyCell($datosInscripcion['pago_monto']);
        $table2->printRow();
        $table2->easyCell("<b>Fecha Deposito: </b>");
        $table2->easyCell($datosInscripcion['pago_fecha']);
        $table2->printRow();
        $table2->endTable(5);

        $table5 = new easyTable($this, 2, 'width:160;align:R{LC}; border-color:#ff5050; border-width:0.7;font-color:#1C3A6E;line-height:1;font-size:8');
        // $table5->rowStyle('font-size:15; valign:J; border:T;line-height:1.3');
        // $table5->easyCell("<b>Nro. ASIENTO: </b>" . $datosInscripcion['numero_asiento']);
        $table5->rowStyle('font-size:10; valign:J; border:T;line-height:1.3');
        $table5->easyCell('<b>Fecha Inscripcion: </b>'.$datosInscripcion['fecha_inscripcion']);
        $table5->printRow();
        // $table5->easyCell('Recuerde el Nro. de Asiento, la cual se le asigno para el dia de su prueba.');
        $table5->easyCell('');
        $table5->printRow();
        $table5->endTable(30);
        $nombreCompletoPostulante = utf8_decode($datosInscripcion['primer_apellido']. ' ' . $datosInscripcion['segundo_apellido'] . ' ' .$datosInscripcion['nombre']) ;
        $valorQR = $datosInscripcion['id_inscripcion_preuniversitario'].'|'.$datosInscripcion['ci'].'|'.$datosInscripcion['numero_asiento'];
    
        $this->Image('http://chart.googleapis.com/chart?chs=60x60&cht=qr&chl='.$valorQR.'&.png',155,130,50,50);
        // $this->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 20, 30, 50, 50, $style, 'N');
        // $this->Text(20, 25, 'QRCODE L');

        $table4 = new easyTable($this, 1, 'width:80; align:C{CCC};border-width:0.2; border-color:#1C3A6E;font-color:#1C3A6E;line-height:1.3;');
        $table4->rowStyle('valign:M; border:T;');
        $table4->easyCell("<b>FIRMA</b>" . "\n<b>" . $nombreCompletoPostulante. "</b>\n<b>" . $datosInscripcion['ci'] . ' ' . $datosInscripcion['expedido'] . '</b>');
        $table4->printRow();
        $table4->endTable(1);

        $table6 = new easyTable($this, 1, 'width:140;');
        $table6->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:6');
        $table6->easyCell('<b>NOTA</b>');
        $table6->printRow();
        $table6->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:6');
        $table6->easyCell("El presente formulario debe ser presentado el dia del Examen de Suficiencia, quedando anulado si en el se encontrase modificaciones,alteraciones,enmiendas,raspaduras y correcciones realizadas en el mismo.", 'align:L;');
        $table6->printRow();
        
        // $table6->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:6');
        // $table6->easyCell("2.-Se expide el presente formulario solo para uso interno de la U.P.E.A. valido para proceso de Admision Estudiantil y con vigencia de 90 dias calendario.", 'align:L;');
        // $table6->printRow();
        $table6->endTable();

        $x =39;
        $this->SetFontSize('9');
        $this->SetTextColor(28, 58, 110);
        $this->SetXY($x,216);
        $this->Cell(20,10,'63120117');

        $this->SetXY($x,225);
        $this->Cell(20,10,'www.medicinaupea.com');
        
        $this->SetXY($x,235);
        $this->Cell(20,10,'Medicina UPEA Bolivia La Paz-El Alto');
        
        $this->Output('formulario_inscripcion.pdf', 'I');
    }
}
