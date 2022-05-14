<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

    $code = $_GET['code'];
    $msg = "";
    // Se mostrará el error correspondiente al pasado por parámetro query como "code"
    switch($code) {
        case 403:
            $msg = "No tiene permisos para acceder a esta página";
            break;
        case 404:
            $msg = "La página solicitada no existe";
            break;
        default:
            $msg = "Se ha producido un error inesperado";
            break;
    }
    echo $blade->view()->make('error', compact('code', 'msg'))->render();
?>