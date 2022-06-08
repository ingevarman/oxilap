<?php

namespace App\Libraries\reportes;

include 'qrcode/qrcode.class.php';

use QRcode;

use App\Libraries\reportes\easytable\exfpdf;
use App\Libraries\reportes\easytable\easyTable;
use PhpParser\Node\Expr\List_;

class Ficha extends exFPDF
{
    public function __construct()
    {
        parent::__construct('P', 'mm', [216, 330]);
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/ficha/ficha.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
        $this->Ln();
        $this->SetLeftMargin(5);
        $this->SetRightMargin(5);
        $this->Ln();
    }

    public function reporte($idPreuniversitario, $descargar = 'I')
    {

        $this->AddPage();
        $this->SetFont('helvetica', '', 8);
        $this->Ln();


        $vistaInscripcionModel = model('VistaInscripcionModel');
        $rowsInscripcion = $vistaInscripcionModel->hoja_respuesta($idPreuniversitario);





        $table = new easyTable($this, '{48,48,48,48}', 'width:150;border-color:#060202; font-size:10;align:{CCCC}');

        $contador = 0;
        $contadorFilas = 0;
        $datosEstudiante = [];
        foreach ($rowsInscripcion as $row) {

            // $url = '/easytable/Pics/a.png';

            ++$contador;

            list($primerNombre) = explode(' ', $row->nombre);

            $nombreEstudiante = utf8_decode(strtoupper($primerNombre . ' ' . $row->primer_apellido . ' ' . $row->segundo_apellido));
            // $longitudNombreEstudiante = strlen($nombreEstudiante);
            // $nombreEstudiante = substr($nombreEstudiante,0,25);

            $datosEstudiante[] = [
                'numeroAsiento' => $row->numero_asiento,
                'codigo' => $row->id_inscripcion_preuniversitario,
                'ci' => $row->ci,
                'nombrePostulante' => $nombreEstudiante,
                'codigoQr' => $row->numero_asiento . '|' . $row->ci . '|' . $nombreEstudiante
            ];

            if ($contador == 4) {
                $this->generar_fila($table, $datosEstudiante);
                $contador = 0;
                $datosEstudiante = [];
                ++$contadorFilas;
            }
            if ($contadorFilas == 9) {
                $this->AddPage();
                $contadorFilas = 0;
            }
        }

        if ($contador > 0 && $contador <= 3) {
            // dd($contador);
            for ($i = $contador; $i <= 4; $i++) {
                $datosEstudiante[] = [
                    'numeroAsiento' => '---',
                    'codigo' => '---',
                    'ci' => '---',
                    'nombrePostulante' => '---',
                    'codigoQr' => '---'
                ];
            }
            $this->generar_fila($table, $datosEstudiante);
        }
        

        $table->endTable();


        $this->Output('codificacion_asientos.pdf', $descargar);
    }


    public function generar_fila($table, $datosEstudiante)
    {

        $qrcode_0 = new QRcode($datosEstudiante[0]['codigoQr'], 'H');
        $qrcode_1 = new QRcode($datosEstudiante[1]['codigoQr'], 'H');
        $qrcode_2 = new QRcode($datosEstudiante[2]['codigoQr'], 'H');
        $qrcode_3 = new QRcode($datosEstudiante[3]['codigoQr'], 'H');

        $y = '5.5';
        $longituQR = 19;
        $qrcode_0->displayFPDF($this, 26, $this->GetY() + $y, $longituQR);
        $qrcode_1->displayFPDF($this, 75, $this->GetY() + $y, $longituQR);
        $qrcode_2->displayFPDF($this, 123, $this->GetY() + $y, $longituQR);
        $qrcode_3->displayFPDF($this, 171, $this->GetY() + $y, $longituQR);

        $table->rowStyle('font-size:11;border:LTR; min-height:25; line-height:1;');
        $table->easyCell("<b>ASIENTO: " . $datosEstudiante[0]['numeroAsiento'] . "</b>");
        $table->easyCell("<b>ASIENTO: " . $datosEstudiante[1]['numeroAsiento'] . "</b>");
        $table->easyCell("<b>ASIENTO: " . $datosEstudiante[2]['numeroAsiento'] . "</b>");
        $table->easyCell("<b>ASIENTO: " . $datosEstudiante[3]['numeroAsiento'] . "</b>");
        $table->printRow();
        $table->rowStyle('font-size:8;border:LR; line-height:0.5;');
        $table->easyCell("<b>Cod: </b>" . $datosEstudiante[0]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[0]['ci']);
        $table->easyCell("<b>Cod: </b>" . $datosEstudiante[1]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[1]['ci']);
        $table->easyCell("<b>Cod: </b>" . $datosEstudiante[2]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[2]['ci']);
        $table->easyCell("<b>Cod: </b>" . $datosEstudiante[3]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[3]['ci']);
        $table->printRow();
        $table->rowStyle('font-size:6;border:LBR; line-height:0.5;');
        $table->easyCell($datosEstudiante[0]['nombrePostulante'], 'align:C;');
        $table->easyCell($datosEstudiante[1]['nombrePostulante'], 'align:C;');
        $table->easyCell($datosEstudiante[2]['nombrePostulante'], 'align:C;');
        $table->easyCell($datosEstudiante[3]['nombrePostulante'], 'align:C;');
        $table->printRow();
    }


    // public function generar_fila($table, $datosEstudiante)
    // {

    //     $table->rowStyle('font-size:11;border:LTR;');
    //     $table->easyCell("<b>ASIENTO: " . $datosEstudiante[0]['numeroAsiento'] . "</b>", $datosEstudiante[0]['codigoQr']);
    //     $table->easyCell("<b>ASIENTO: " . $datosEstudiante[1]['numeroAsiento'] . "</b>", $datosEstudiante[1]['codigoQr']);
    //     $table->easyCell("<b>ASIENTO: " . $datosEstudiante[2]['numeroAsiento'] . "</b>", $datosEstudiante[2]['codigoQr']);
    //     $table->easyCell("<b>ASIENTO: " . $datosEstudiante[3]['numeroAsiento'] . "</b>", $datosEstudiante[3]['codigoQr']);
    //     $table->printRow();
    //     $table->rowStyle('font-size:10;border:LR;');
    //     $table->easyCell("<b>Cod: </b>" . $datosEstudiante[0]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[0]['ci']);
    //     $table->easyCell("<b>Cod: </b>" . $datosEstudiante[1]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[1]['ci']);
    //     $table->easyCell("<b>Cod: </b>" . $datosEstudiante[2]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[2]['ci']);
    //     $table->easyCell("<b>Cod: </b>" . $datosEstudiante[3]['codigo'] . "   <b>CI: </b>" . $datosEstudiante[3]['ci']);
    //     $table->printRow();
    //     $table->rowStyle('font-size:6;border:LBR;');
    //     $table->easyCell($datosEstudiante[0]['nombrePostulante']);
    //     $table->easyCell($datosEstudiante[1]['nombrePostulante'], 'border:LBR;align:C;');
    //     $table->easyCell($datosEstudiante[2]['nombrePostulante'], 'border:LBR;align:C;');
    //     $table->easyCell($datosEstudiante[3]['nombrePostulante'], 'border:LBR;align:C;');
    //     $table->printRow();
    // }
}
