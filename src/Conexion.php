<?php
namespace Clases;
use PDO;

class Conexion {
    private static $host = "localhost";
    private static $db = "bibliotech_daw";
    private static $user = "adminBD";
    private static $pass = "passwordBD";
    private $conexion;

    public function __construct(){
        // Establecer conexión con base de datos
        $this->conexion=new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$user, self::$pass);
        // Permitir capturar las excepciones
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConexion(){
        return $this->conexion;
    }
}
?>