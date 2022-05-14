<?php
namespace Clases;

use Clases\Utils\Funciones;
use PDO;

class Conexion {
    private $conexion;

    public function __construct(){
        $config = Funciones::obtenerConfiguracion();
        // Establecer conexión con base de datos
        $this->conexion=new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['db'], $config['database']['user'], $config['database']['pass']);
        // Permitir capturar las excepciones
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConexion(){
        return $this->conexion;
    }
}
?>