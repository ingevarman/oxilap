<?php

// Funcion : Usada para devolver los valores de un campo enum de una tabla

if (!function_exists('get_enum_valores')) {

    function get_enum_valores($tabla, $field)
    {
        $db = \Config\Database::connect();
        $type = $db->query("SHOW COLUMNS FROM {$tabla} WHERE Field = '{$field}'")->getRow()->Type;;

        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
}

// Funcion : Usada para devolver los valores de un campo enum de una tabla

if (!function_exists('get_select_enum')) {

    function get_select_enum($tabla, $field, $valorVacio = false, $class = 'form-control')
    {
        $valoresEnum = get_enum_valores($tabla, $field);
        $html = '<select id="id_' . $field . '" name="' . $field . '" class="' . $class . '">';
        if ($valorVacio == true) {
            $html .= "<option value=''>...</option>";
        }

        foreach ($valoresEnum as $valor) {
            $html .= "<option value='$valor'> $valor</option>";
        }
        $html .= "</select>";

        return $html;
    }
}


// Funcion : Usada para devolver mensajes

if (!function_exists('mensaje')) {

    function mensaje($mensaje, $tipo = 'error')
    {
        $html = '';
        $estilo = 'secondary';
        switch ($tipo) {
            case 'primary':
                $estilo = 'primary';
                break;
            case 'secondary':
                $estilo = 'secondary';
                break;
            case 'success':
                $estilo = 'success';
                break;
            case 'danger':
                $estilo = 'danger';
                break;
            case 'warning':
                $estilo = 'warning';
                break;
            case 'dark':
                $estilo = 'dark';
                break;
        }

        $html = '
                <div class="alert alert-' . $estilo . ' alert-dismissible fade show" role="alert">
                    ' . $mensaje . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    ';
        return $html;
    }
}




