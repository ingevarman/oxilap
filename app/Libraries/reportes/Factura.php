<?php

namespace App\Libraries\reportes;
use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;

class Factura extends exFPDF
{
    public function __construct()
    {
        parent::__construct('P', 'mm', 'letter');
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/factura/factura.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln(4);
        $this->SetLeftMargin(20);
        $this->SetRightMargin(15);
        $this->Ln();
    }

    public function reporte()
    {
        $nit= '8343134';
        $nrofactura = '403837646';
        $autorizacion='1234567';
        $contrato='idcontrato';
        $cobranza='23213';
        $linea='77285633';
        $fechaPago='12/5/2021'; 
        $nombre='Sergio Garcia';
        $direccion='SAn Luis';
        $zona='Concepcion';
        $ciudad='La Paz';
        $plan='Mega PLan'; 
        $nit_ci='123456';     
        
        $this->AddPage();             
        $this->SetFont('helvetica','',8); 
       
        $table=new easyTable($this, 3);    
        // $table1->rowStyle('font-size:10;');
        $table->easyCell('');
        $table->easyCell("<b>SUPER TV COM</b>\n Dir. GALERIA BOLIVAR\nOf. Calle Bolivar\nTelf.8232632\nCel.76799717-76799711\nEmail:super.tv.com007@gmail.com",'font-color:#1C3A6E');
        $table->easyCell("<b>NIT:</b>".$nit."\n<b>Nro.Factura:</b>".$nrofactura."\n<b>Autorizacion:</b>".$autorizacion."\n<b>Linea:</b>".$linea."\n<b>Contrato:</b>".$contrato."\n<b>Cobranza:</b>".$cobranza."\n<b>Fecha de Pago:</b>".$fechaPago,'align:L;font-color:#1C3A6E','align:L;');
        $table->printRow(); 
        $table->endTable(5);

        $tipoDocumento='Factura';

        $table1=new easyTable($this, 3);    
       // $table1->rowStyle('font-size:10;');
        $table1->easyCell('<b>'.$tipoDocumento.'</b>','font-size:30;font-color:#1C3A6E;font-family:helvetica;valign:M');
        $table1->rowStyle('font-size:10;');
        $table1->easyCell("<b>Nombre:</b>".$nombre."\n<b>NIT/CI:</b>".$nit_ci."\n<b>Direccion:</b>".$direccion."\n<b>Zona:</b>".$zona."\n<b>Ciudad:</b>".$ciudad."\n<b>Plan:</b>".$plan,'align:L;font-color:#1C3A6E','align:L;');
        $table1->easyCell('');
        $table1->printRow(); 
     
        $table1->endTable();
       

        $datosFactura=[];
        //$datosFactura[]=[
         //   'detalle'=>'TV CABLE',
         //   'cantidad'=>'2',
        //    'unitario'=>'45',
         //   'subTotal'=>'90'
        //];
       // $datosFactura[]=[
           // 'detalle'=>'TV CABLE',
           // 'cantidad'=>'2',
           // 'unitario'=>'45',
            //'subTotal'=>'90'
       // ];
       
     
     
        $table2=new easyTable($this,'{10,105, 20, 20,20}','align:C{CLCCR};');
        $table2->rowStyle('valign:M; bgcolor:#D6D7D9;font-color:#1C3A6E; font-family:helvetica; font-style:B;font-size:10');
        $table2->easyCell('No');
        $table2->easyCell('Detalle','align:C');
        $table2->easyCell('Cantidad');
        $table2->easyCell('Unitario');
        $table2->easyCell('Sub Total','align:C');       
        $table2->printRow();
        $cont=0;       
       
      
        if(empty($datosFactura))
        {
            $table2->rowStyle('valign:M;font-color:#292B3A;font-style:B; font-family:helvetica;font-size:12');
            $table2->easyCell('La '.$tipoDocumento.' no cuenta con datos','align:C;colspan:5;');          
            $table2->printRow();
        }
        else
        {
            $cont=0;   
        
            foreach($datosFactura as $row)
            {
                $cont++;                          
                $table2->rowStyle('valign:M; font-color:#1C3A6E; font-family:helvetica;font-size:8');                 
                $table2->easyCell($cont);
                $table2->easyCell($row['detalle']);
                $table2->easyCell($row['cantidad']);
                $table2->easyCell($row['unitario']);
                $table2->easyCell($row['subTotal']);
                $table2->printRow();           
            }   
        }        
        $table2->endTable();

        $table3=new easyTable($this,1,'');   
        $table3->rowStyle('font-color:#1C3A6E; font-family:helvetica;font-size:6');
        $table3->easyCell("1.-Senor usuario,pague a tiempo sus facturas,evite los cortes y costos de reconexion.\n2.-Pasado los dos meses de mora la empresa realizara el corte del servicio\n<b>Esta empresa esta regulada y fiscalizada por la ATT.</b> ");
        $table3->printRow();
        $table3->endTable();   

        $this->Output('garmaser.pdf','I');

  
    }
}
