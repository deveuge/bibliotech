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
}
?>