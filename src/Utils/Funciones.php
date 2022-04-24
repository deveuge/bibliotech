<?php
namespace Clases\Utils;
use \Datetime;
use \DateInterval;

class Funciones {

    public static function getFechaDevolucion(){
        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        return $date;
    }

    public static function getLabelMes($mes) {
        $array = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
        return $array[$mes - 1];
    }

    public static function getAlertaSolicitudPrestamo() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(!isset($_GET["booked"])) {
            return null;
        }
        switch ($_GET["booked"]) {
            case 1:
                return new Alert("Solicitud de préstamo realizada correctamente.<br>Acuda a la biblioteca para recoger su ejemplar.", "success");
            case 2:
                return new Alert("No existen ejemplares disponibles para el préstamo.", "danger");
            case 3:
                return new Alert("Actualmente ya tiene este libro en préstamo.", "danger");
            case 4:
                return new Alert("No existe el libro solicitado.", "danger");
            default:
                return null;
        }
    }
}
?>