<?php
namespace Clases;
require_once '../vendor/autoload.php';
use Clases\Conexion;
use Clases\Utils\Funciones;

class Prestamo {
    private $id;
    private $usuario;
    private $libro;
    private $devuelto;
    private $fechaAsignadaDevolucion;
    private $fechaRealDevolucion;
    private $fechaCreacionPrestamo;
    
    public function __construct() {
        $num = func_num_args();
        switch ($num) {
            case 7:
                $this->id = func_get_arg(0);
                $this->usuario = func_get_arg(1);
                $this->libro = func_get_arg(2);
                $this->devuelto = func_get_arg(3);
                $this->fechaAsignadaDevolucion = func_get_arg(4);
                $this->fechaRealDevolucion = func_get_arg(5);
                $this->fechaCreacionPrestamo = func_get_arg(6);
                break;
        }
    }

    public static function list($filtro) {
        $resultados = array();
        $conexion = new Conexion();

        $stmt = $conexion->getConexion()->prepare(Prestamo::construirQuery($filtro));
        $stmt->execute();
        while ($resultado = $stmt->fetch()) {
            array_push($resultados, new Prestamo(
                $resultado['id'],
                new Usuario($resultado['user_id'], $resultado['user_name'], null, null, null),
                new Libro($resultado['book_id'], $resultado['book_name'], $resultado['book_author'], $resultado['book_description']),
                $resultado['returned'],
                $resultado['assigned_return_date'],
                $resultado['real_return_date'],
                $resultado['created_at']
            ));
        }
        return $resultados;
    }

    private static function construirQuery($filter) {
        $agregarWhere = $filter->hasFilter() ? " WHERE " : "";
        $agregarFiltros = $filter->getFilterQuery();
        $agregarOrden = $filter->getOrderQuery();
        $filas = $filter->getFilas();
        $offset = ($filter->getPagina() - 1) * $filas;
        return <<<EOD
            SELECT l.*, u.name AS user_name, b.name AS book_name, b.author AS book_author, b.description AS book_description FROM lending l 
            JOIN user u ON l.user_id = u.username 
            JOIN book b ON l.book_id = b.isbn 
            $agregarWhere $agregarFiltros $agregarOrden 
            LIMIT $filas OFFSET $offset
        EOD;
    }

    public static function countList($filtro) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->query(Prestamo::construirQueryCount($filtro));
        return $stmt->fetch()[0];
    }
    
    private static function construirQueryCount($filter) {
        $agregarWhere = $filter->hasFilter() ? " WHERE " : "";
        $agregarFiltros = $filter->getFilterQuery();
        return <<<EOD
            SELECT COUNT(*) FROM lending l 
            JOIN user u ON l.user_id = u.username 
            JOIN book b ON l.book_id = b.isbn 
            $agregarWhere $agregarFiltros
        EOD;
    }

    public static function existePrestamoActivo($usuario, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT COUNT(*) FROM lending WHERE user_id = ? AND book_id = ? AND returned = 0");
        $stmt->execute([$usuario, $isbn]);
        return $stmt->fetch()[0] > 0;
    }

    public static function insertarPrestamo($usuario, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("INSERT INTO lending (`user_id`, `book_id`, `assigned_return_date`, `created_at`) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $usuario,
            $isbn,
            Funciones::getFechaDevolucion()->format('Y-m-d H:i:s'),
            date_create()->format('Y-m-d H:i:s')
        ]);
    }

    public static function devolverPrestamo($usuario, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("UPDATE lending SET returned = 1, real_return_date = ? WHERE user_id = ? AND book_id = ? AND returned = 0");
        $stmt->execute([
            date_create()->format('Y-m-d H:i:s'),
            $usuario,
            $isbn
        ]);
    }

    /* GETTERS */
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getLibro() {
        return $this->libro;
    }

    public function getDevuelto() {
        return $this->devuelto;
    }

    public function getFechaAsignadaDevolucion() {
        return date_create($this->fechaAsignadaDevolucion)->format('d/m/Y');
    }

    public function getFechaAsignadaDevolucionInput() {
        if(!$this->fechaAsignadaDevolucion) {
            return '';
        }
        return date_create($this->fechaAsignadaDevolucion)->format('Y-m-d');
    }

    public function getFechaRealDevolucion() {
        return date_create($this->fechaRealDevolucion)->format('d/m/Y');
    }

    public function getFechaRealDevolucionInput() {
        if(!$this->fechaRealDevolucion) {
            return '';
        }
        return date_create($this->fechaRealDevolucion)->format('Y-m-d');
    }
    
    public function getFechaCreacionPrestamo() {
        return date_create($this->fechaCreacionPrestamo)->format('d/m/Y');
    }

    public function getEstado() {
        if($this->devuelto) {
            return 'Devuelto';
        } 
        if($this->esFueraDePlazo()) {
            return 'Fuera de plazo';
        } else {
            return 'En plazo';
        }
    }

    public function esFueraDePlazo() {
        return !$this->devuelto && strtotime(date_create()->format('Y-m-d')) > strtotime($this->getFechaAsignadaDevolucionInput());
    }

}
?>