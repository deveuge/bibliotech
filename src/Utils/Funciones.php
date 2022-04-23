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
}
?>