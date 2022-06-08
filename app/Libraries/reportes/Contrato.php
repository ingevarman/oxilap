<?php

namespace App\Libraries\reportes;

// use App\Libraries\reportes\easytable\exfpdf;
// use App\Libraries\reportes\easytable\easyTable;
use setasign\Fpdi\TcpdfFpdi;


class Contrato extends TcpdfFpdi
{
    public function __construct()
    {
        parent::__construct('P', 'mm', [216, 330]);

        // Establecemos los márgenes izquierda, arriba y derecha:
        $this->SetMargins(29, 29, 19);
        // Establecemos el margen inferior:
        $this->SetAutoPageBreak(true, 19);
    }
    function Header()
    {
        $this->setSourceFile(APPPATH . 'Libraries/reportes/contrato/contrato_inicial.pdf');
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, 0);
    }

    function Footer()
    {
    }

    public function reporte($idAbonado)
    {
        helper('supertvcom');

        $parser = \Config\Services::parser();
        $reporteModel =  model('ReporteModel');
        $vistaAbonadoModel = model('VistaabonadoModel');

        $rowReporte = $reporteModel->find(1);
        $template = $rowReporte['contenido_reporte'];


        $rowAbonado = $vistaAbonadoModel->find($idAbonado);
        if (empty($rowAbonado['fecha_contrato'])) {
            $reporteHtml = '<br><br><h1> No se tiene definido la fecha de contrato para este contrato. </h1>';
        }else{
            list($gestionContrato, $mesContrato, $diaContrato) = explode('-', $rowAbonado['fecha_contrato']);
            $data     = [
                'nombre_completo_abonado' => strtoupper($rowAbonado['nombre_completo_abonado']),
                'ci_expedito' => $rowAbonado['ci_expedito'],
                'direccion' => 'Zona '.strtoupper($rowAbonado['nombre_zona'].', '.$rowAbonado['direccion']),
                'sucursal' => strtoupper($rowAbonado['nombre_sucursal']),
                'gestion_contrato' => $gestionContrato,
                'mes_contrato' => mes_literal($mesContrato),
                'dia_contrato' => $diaContrato
            ];
            $reporteHtml = $parser->setData($data)->renderString($template);
        }
        $this->AddPage();
        $this->SetFontSize('8');

        $this->writeHTML($reporteHtml, true, false, true, false, '');
        $nombreArchivo = 'contrato-';
        $nombreArchivo .= $rowAbonado['nombre_completo_abonado'];
        $this->Output($nombreArchivo . '.pdf', 'I');
    }
}
