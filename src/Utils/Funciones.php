<?php
namespace Clases\Utils;
use \Datetime;
use \DateInterval;

class Funciones {

    public static function comprobarAccesoModerador() {
        if(!$_SESSION['usuario']->esModerador()) {
            header("Location: error.php?code=403");
            exit();
        }
    }

    public static function comprobarError404($obj) {
        if($obj == null) {
            header("Location: error.php?code=404");
            exit();
        }
    }

    public static function getFechaDevolucion(){
        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        return $date;
    }

    public static function getLabelMes($mes) {
        $array = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
        return $array[$mes - 1];
    }

    public static function getAlertaLibro() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(isset($_GET["updated"])) {
            return new Alert("Libro actualizado correctamente", "success");
        }
        if(isset($_GET["created"])) {
            return new Alert("Libro registrado correctamente", "success");
        }
        if(isset($_GET["deleted"])) {
            return new Alert("Libro eliminado correctamente", "success");
        }
        return null;
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
    
    public static function getAlertaDevolucionPrestamo() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(!isset($_GET["returned"])) {
            return null;
        }
        switch ($_GET["returned"]) {
            case 1:
                return new Alert("Devolución realizada correctamente.", "success");
            case 2:
                return new Alert("El usuario no tiene actualmente el libro en préstamo.", "danger");
            case 3:
                return new Alert("No existe el libro solicitado.", "danger");
            default:
                return null;
        }
    }
}
?>