<?php

namespace App\Libraries\reportes;

use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;

class Historial extends exFPDF
{
    public function __construct()
    {
        parent::__construct('P', 'mm', 'letter');
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/historial/historial.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);
        $this->SetLeftMargin(20);
        $this->SetRightMargin(15);
        $this->Ln();

    }
    public function reporte($idAbonado)
    {
        $vistaAbonadoModel = model('VistaabonadoModel');
        $rowAbonado = $vistaAbonadoModel->find($idAbonado);
        //$rowAbonado = $vistaAbonadoModel->orderBy('id_abonado','desc')->limit(12)->find($idAbonado);
        $codigo = $rowAbonado['codigo_abonado'];
        $categoria = $rowAbonado['nombre_categoria'];
        $paquete = $rowAbonado['nombre'];
        $puntos = $rowAbonado['regular_puntos'];
        $ampliacionPuntos = $rowAbonado['ampliacion_puntos'];
        $ci= $rowAbonado['ci_expedito'];
        $fechaContrato = $rowAbonado['fecha_contrato'];
        $fechaInstalacion = $rowAbonado['fecha_instalacion'];
        $sucursal = ucwords(strtolower($rowAbonado['nombre_sucursal']));
        $nombre = ucwords(strtolower($rowAbonado['nombre_completo_abonado']));
        $zona = ucwords(strtolower($rowAbonado['nombre_zona']));
        $direccion = ucwords(strtolower($rowAbonado['direccion']));
        $this->AddPage();
        $this->SetFont('helvetica', '', 8);
        $this->Ln(20);
        $tipoDocumento = 'Historial Pagos';
        
        $table = new easyTable($this, 3);
        // $table1->rowStyle('font-size:10;');
        $table->easyCell('');
        $table->easyCell("<b> $tipoDocumento </b>", 'font-size:20;font-color:#1C3A6E;font-family:helvetica;valign:M');
        $table->easyCell('');
        $table->printRow();
        $table->endTable(5);

        $table1 = new easyTable($this, 4);
        $table1->easyCell("<b> Paquete</b> \n\n<b> $paquete </b>", 'font-size:11;font-color:#1C3A6E;font-family:helvetica;align:C;');
        $table1->rowStyle('font-size:9;');
        $table1->easyCell("<b>Sucursal: </b> $sucursal \n<b>Codigo Abonado: </b> $codigo \n<b>Categoria: </b> $categoria \n<b>Puntos: </b>  $puntos \n<b>Ampliacion: </b> $ampliacionPuntos",'align:L;font-color:#1C3A6E', 'align:L;');
        $table1->easyCell("<b>Fecha Contrato: </b> $fechaContrato \n<b>Fecha Instalacion: </b> $fechaInstalacion \n<b>Zona: </b> $zona \n<b>Direccion: </b> $direccion", 'align:L;font-color:#1C3A6E', 'align:L;');
        $table1->easyCell("<b>Nombre: </b> $nombre \n<b>CI: </b> $ci", 'align:L;font-color:#1C3A6E', 'align:L;');
        //$table4->easyCell('');
        $table1->printRow();
        $table1->endTable(6);

        $rowHistorial = $this->datos();
        
        // $datosFactura[]=[
        // 'detalle'=>'TV CABLE',
        // 'cantidad'=>'2',
        // 'unitario'=>'45',
        //'subTotal'=>'90'
        // ];
        $table2 = new easyTable($this, '{35,20, 35, 30,25,25}', 'align:C{CCCCCC};');
        $table2->rowStyle('valign:M; bgcolor:#D6D7D9;font-color:#1C3A6E; font-family:helvetica; font-style:B;font-size:10');
        $table2->easyCell('# Transaccion', 'align:C');
        $table2->easyCell('Gestion', 'align:C');
        $table2->easyCell('Periodo', 'align:C');
        $table2->easyCell('Fecha Pago', 'align:C');
        $table2->easyCell('Monto', 'align:C');
        $table2->easyCell('Estado', 'align:C');
        $table2->printRow();
        $cont = 0;
        if (empty($rowHistorial)) {
            $table2->rowStyle('valign:M;font-color:#292B3A;font-style:B; font-family:helvetica;font-size:12');
            $table2->easyCell('El ' . $tipoDocumento . ' no cuenta con datos', 'align:C;colspan:5;');
            $table2->printRow();
        } else {
            $cont = 0;
            //$customers = array_slice($rowHistorial, 0, 10);
            //$elemento = array_shift($rowHistorial);
            foreach ($rowHistorial as $row) {
                $cont++;
                $table2->rowStyle('valign:M; font-color:#1C3A6E; font-family:helvetica;font-size:8');
                $table2->easyCell($cont);
                $table2->easyCell($row['gestion']);
                $table2->easyCell($row['periodo']);
                $table2->easyCell($row['fecha_pago']);
                $table2->easyCell($row['precio']);
                $table2->easyCell($row['estado']);
                $table2->printRow();
            }
        }
        $table2->endTable();
        $table3 = new easyTable($this, 1, '');
        $table3->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:6');
        $table3->easyCell("1.-La información en el documento presente es un extracto detallado del consumo que está consignado en su factura.\n2.-El documento presente no es una factura, nota fiscal o documento equivalente.\n3.- El presente no es válido para crédito fiscal.\n4.- Los datos contenidos en el documento están sujetos a validación con el documento original que es la factura. ");
        $table3->printRow();
        $table3->endTable();
        $this->Output('garmaser.pdf', 'I');
    }

    function datos(){
        $rowHistorial = [];
         for($i=0; $i<=29;$i++)
        {
            $rowHistorial[] = [
                'gestion'=>'2020',
                'periodo' => 'ENERO',
                'fecha_pago' => '12-01-2020',
                'precio' => '90',
                'estado' => 'Pagado'
    
            ];
        }
        
        return $rowHistorial;
    }
}
