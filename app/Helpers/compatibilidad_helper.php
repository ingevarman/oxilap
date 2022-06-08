<?php
// Funciones para dar compatibilidad de campos con el sistema de preuniversitario de la UPEA

function genero($valor)
{
    $datos = [
        'M' => 'MASCULINO',
        'F' => 'FEMENINO'
    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}


function tipo_documento($valor)
{
    $datos = [
        '1' => 'CI',
        '2' => 'RUC',
        '3' => 'LIBRETA SERVICIO MILITAR'
    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}

function departamento($valor)
{
    $datos = [
        '1' => 'LA PAZ',
        '2' => 'ORURO',
        '3' => 'COCHABAMBA',
        '4' => 'CHUQUISACA',
        '5' => 'PANDO',
        '6' => 'SANTA CRUZ',
        '7' => 'POTOSÍ',
        '8' => 'BENI',
        '9' => 'TARIJA'
    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}

function titulo_bachiller_universidad($valor)
{
    $datos = [
        '1' => 'UNIVERSIDAD PUBLICA DE EL ALTO',
        '2' => 'UNIVERSIDAD MAYOR DE SAN ANDRES',
        '3' => 'UNIVERSIDAD TECNICA DE ORURO',
        '4' => 'UNIVERSIDAD MAYOR DE SAN SIMON',
        '5' => 'UNIVERSIDAD AUTONOMA TOMAS FRIAS',
        '6' => 'UNIVERSIDAD AUTONOMA GABRIEL RENE MORENO',
        '7' => 'UNIVERSIDAD AUTONOMA JUAN MISAEL SARACHO',
        '8' => 'UNIVERSIDAD AUTONOMA DEL BENI MCAL. JOSE BALLIVIAN',
        '9' => 'UNIVERSIDAD NACIONAL DE SIGLO XX',
        '10' => 'UNIVERSIDAD AMAZONICA DE PANDO',
        '11' => 'UNIVERSIDAD MAYOR REAL Y PONTIFICA DE SAN FRANCISCO XAVIER',
        '12' => 'MINISTERIO DE EDUCACION O SEDUCA',
        '13' => 'EXTRANJERO',
        '14' => 'UNIVERSIDAD MILITAR "MCAL. BERNARDINO BILBAO RIOJA"'

    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}

function socio_economico_vivienda_habita($valor)
{
    $datos = [
        '8' => 'CASA',
        '9' => 'DEPARTAMENTO',
        '10' => 'HABITACION',
        '11' => 'RESIDENCIAL',
        '12' => 'INTERNADO',
        '13' => 'OTRO'
    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}

function socio_economico_vivienda_caracteristica($valor)
{
    $datos = [
        '9' => 'PROPIA DE PADRES',
        '10' => 'ALQUILADA',
        '11' => 'PRESTADA',
        '12' => 'ANTICRETICO',
        '13' => 'ADJUDICADA'
    ];

    if (!empty($datos[$valor])) {
        $valor = $datos[$valor];
    }
    return $valor;
}
