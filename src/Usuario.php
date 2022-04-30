<?php
namespace Clases;
require_once '../vendor/autoload.php';
use Clases\Conexion;

class Usuario {
    private $username;
    private $nombre;
    private $email;
    private $imagen;
    private $rol;

    public function __construct(){
        $num = func_num_args();
        switch ($num) {
            case 3:
                $this->username = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->imagen = func_get_arg(2);
                break;
            case 5:
                $this->username = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->email = func_get_arg(2);
                $this->imagen = func_get_arg(3);
                $this->rol = func_get_arg(4);
                break;
        }
    }

    public static function findUsuario($email, $password) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        $stmt->execute([$email, hash('sha256', $password)]);
        $resultado = $stmt->fetch();
        if($resultado == null) {
            return null;
        }
        return new Usuario(
            $resultado['username'],
            $resultado['name'],
            $resultado['email'],
            $resultado['image'],
            $resultado['role']
        );
    }

    public static function findUsuarioPorUsername($username) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $resultado = $stmt->fetch();
        if($resultado == null) {
            return null;
        }
        return new Usuario(
            $resultado['username'],
            $resultado['name'],
            $resultado['email'],
            $resultado['image'],
            $resultado['role']
        );
    }

    public static function updateUsuario($usuario) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("UPDATE user SET name = ?, image = ? WHERE username = ?");
        $stmt->execute([
            $usuario->getNombre(),
            $usuario->getImagenIndex(),
            $usuario->getUsername()
        ]);
    }
    
    public static function updatePassword($username, $password) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("UPDATE user SET password = ? WHERE username = ?");
        $stmt->execute([
            hash('sha256', $password),
            $username
        ]);
    }

    public static function existeUsuarioPorUsername($username) {
        return Usuario::existeUsuario($username, "username");
    }

    public static function existeUsuarioPorEmail($email) {
        return Usuario::existeUsuario($email, "email");
    }

    private static function existeUsuario($valor, $campo) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT * FROM user WHERE " . $campo ." = ?");
        $stmt->execute([$valor]);
        $resultado = $stmt->fetch();
        return $resultado != null;
    }

    public static function insertarUsuario($username, $email, $password) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("INSERT INTO user (`username`, `email`, `password`, `role`) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $username,
            $email,
            hash('sha256', $password),
            'USER'
        ]);
    }

    /* GETTERS */
    public function getUsername() {
        return $this->username;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getImagen() {
        return 'img/avatars/' . $this->getImagenIndex() . '.png';
    }

    public function getImagenIndex() {
        return $this->imagen == null ? 0 : $this->imagen;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getRolname() {
        switch($this->rol) {
            case 'ADMIN':
                return 'Administrador';
            case 'MOD':
                return 'Moderador';
            default:
                return 'Alumno';
        }
    }

    public function esModerador() {
        return $this->rol == 'MOD';
    }

    /* SETTERS */
    public function setNombre($n) {
        $this->nombre=$n;
    }

    public function setEmail($e) {
        $this->email=$e;
    }

    public function setImagen($i) {
        $this->imagen=$i;
    }
}
?>