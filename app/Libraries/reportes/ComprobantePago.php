<?php

namespace App\Libraries\reportes;

use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;


class ComprobantePago extends exFPDF
{
    public function __construct()
    {
        parent::__construct('P', 'mm', 'letter');
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/comprobantePago/comprobantePago.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);
        $this->SetLeftMargin(20);
        $this->SetRightMargin(15);
        $this->Ln();
    }

    public function reporte($datosComprobante)
    {

        $this->AddPage();
        $this->SetFont('helvetica', '', 8);

        $tipoDocumento = 'COMPROBANTE DE PAGO';
        // $datosComprobante  = [
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
        //     'fecha_inscripcion' => '18/10/2021',
        //     'usuario'


        // ];
        // $datosComprobante[] = [
        //     'nombre_producto' => 'preuniversitario',
        //     'costo_producto' => '100'
        // ];
        // $datosComprobante[] = [
        //     'nombre_producto' => 'preuniversitario',
        //     'costo_producto' => '200'
        // ];
        $usuario = '';
        $posicionY = 45;
        for ($i = 1; $i <= 2; $i++) {
            if ($i == 2) {
                $posicionY = 180;
            }
            $this->setY($posicionY);
            $table1 = new easyTable($this, 1, 'font-size:18;font-color:#1C3A6E;font-family:helvetica;align:C{CC}');
            $table1->easyCell('<b>' . $tipoDocumento . '</b>');
            $table1->printRow();
            $table1->endTable(5);

            $table2 = new easyTable($this, 1, 'width:140;align:C;border-width:0.10;font-color:#fff; font-color:#1C3A6E;font-size:10;line-height:0.6;');
            $table2->easyCell("<b>Postulante: </b>" . utf8_decode($datosComprobante['nombre'] . ' ' . $datosComprobante['primer_apellido'] . ' ' . $datosComprobante['segundo_apellido']));
            $table2->printRow();
            $table2->endTable();

            $table3 = new easyTable($this, '{40,60,40}', 'width:140;align:{LCR};border-width:0.10;font-color:#fff; font-color:#1C3A6E;font-size:10;line-height:0;');
            $table3->easyCell("<b>CI: </b>" . $datosComprobante['ci'] . ' ' . $datosComprobante['expedido']);
            $table3->easyCell("<b>Fecha: </b>" . $datosComprobante['fecha_venta']);
            $table3->easyCell("<b>Nro: </b>" . str_pad($datosComprobante['id_venta'],5,'0',STR_PAD_LEFT));
            $table3->printRow();
            $table3->endTable();


            $table4 = new easyTable($this,'{20,100,20}', 'width:140; bgcolor:#fff; border-width:0.5;font-color:#1C3A6E;line-height:1;font-size:10;align:C{LLC};');
            $table4->rowStyle('valign:M; bgcolor:#e71026;font-color:#fff; font-family:helvetica; font-style:B;font-size:10');
            $table4->easyCell('No');
            $table4->easyCell('Detalle');
            $table4->easyCell('Total', 'align:C');
            $table4->printRow();
            $cont = 0;
            if (empty($datosComprobante)) {
                $table4->rowStyle('valign:M;font-color:#292B3A;font-style:B; font-family:helvetica;font-size:12');
                $table4->easyCell('La ' . $tipoDocumento . ' no cuenta con datos', 'align:C;colspan:5;');
                $table4->printRow(1);
            } else {
                $cont = 0;
                // foreach ($datosComprobante as $row) {
                    $cont++;
                    $table4->rowStyle('valign:M; font-color:#1C3A6E; font-family:helvetica;font-size:9;line-height:1.6');
                    $table4->easyCell($cont);
                    $table4->easyCell(utf8_decode($datosComprobante['nombre_producto']));
                    $table4->easyCell($datosComprobante['costo_producto'].' Bs');
                    $table4->printRow();
                // }
            }
            $table4->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:10;line-height:0.6');
            $table4->easyCell('<b>TOTAL</b>', 'colspan:2;align:R');
            $table4->easyCell('<b>' . $datosComprobante['costo_producto'] . ' Bs</b>');
            $table4->printRow();
            $table4->endTable(20);

            $table5 = new easyTable($this, 2, 'width:150; align:C{CC};font-size:7;font-color:#1C3A6E;line-height:1;');
            $table5->easyCell("<b>_________________________</b>\n<b>ENTREGUE CONFORME</b>" . "\n<b>" . utf8_decode($datosComprobante['primer_apellido'] . ' ' . $datosComprobante['segundo_apellido'] . ' ' . $datosComprobante['nombre']) . "</b>\n<b>" . $datosComprobante['ci'] . ' ' . $datosComprobante['expedido'] . '</b>');
            $table5->easyCell("<b>_________________________</b>\n<b>RECIBI CONFORME</b>" . "\n<b>$usuario</b>");
            $table5->printRow();
            $table5->endTable();
        }
        $this->Output('garmaser.pdf', 'I');
    }
}
