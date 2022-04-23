<?php
namespace Clases;
require_once '../vendor/autoload.php';
use Clases\Conexion;
use Clases\Utils\Funciones;

class Estadisticas {
    private $libros;
    private $autores;
    private $favoritos;
    private $prestamos;
    private $categoriasFavoritas;
    private $librosLeidos;

    public function __construct() {
        $num = func_num_args();
        switch ($num) {
            case 6:
                $this->libros = func_get_arg(0);
                $this->autores = func_get_arg(1);
                $this->favoritos = func_get_arg(2);
                $this->prestamos = func_get_arg(3);
                $this->categoriasFavoritas = func_get_arg(4);
                $this->librosLeidos = func_get_arg(5);
                break;
        }
    }

    public static function getEstadisitcas($user) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare(
            <<<EOD
            SELECT COUNT(DISTINCT(b.name)) AS libros, COUNT(DISTINCT(b.author)) AS autores, (SELECT COUNT(*) FROM lending WHERE user_id = ? AND returned = 0) AS prestamos 
            FROM lending l JOIN book b ON l.book_id=b.ISBN 
            WHERE user_id = ? 
            EOD
        );
        $stmt->execute([$user, $user]);
        $resultado = $stmt->fetch();
        return new Estadisticas(
            $resultado['libros'],
            $resultado['autores'],
            0, // TODO
            $resultado['prestamos'],
            Estadisticas::consultarCategoriasFavoritas($user),
            Estadisticas::consultarLibrosLeidos($user)
        );
    }

    public static function consultarCategoriasFavoritas($user) {
        $resultados = array();
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare(
            <<<EOD
            SELECT c.name AS categoria, COUNT(DISTINCT(l.book_id)) AS total 
            FROM lending l JOIN book b on l.book_id = b.ISBN JOIN category c ON b.category_id = c.id 
            WHERE l.user_id = ? GROUP BY c.name LIMIT 5
            EOD
        );
        $stmt->execute([$user]);
        while ($resultado = $stmt->fetch()) {
            array_push($resultados, array($resultado['categoria'], $resultado['total']));
        }
        return $resultados;
    }

    public static function consultarLibrosLeidos($user) {
        $resultados = array();
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare(
            <<<EOD
            (SELECT CAST(m.meses AS UNSIGNED) as mes, COUNT(id) AS total FROM (
                select 1 as meses union all
                select 2 union all
                select 3 union all
                select 4 union all
                select 5 union all
                select 6 union all
                select 7 union all
                select 8 union all
                select 9 union all
                select 10 union all
                select 11 union all
                select 12 
                ) m 
            left join lending on m.meses = month(real_return_date) AND YEAR(real_return_date) = YEAR(curdate()) AND returned = 1 AND user_id = ?
                group by m.meses
                order by m.meses) ORDER BY mes;
            EOD
        );
        $stmt->execute([$user]);
        while ($resultado = $stmt->fetch()) {
            $resultados[$resultado['mes']] = $resultado['total'];
        }
        return $resultados;
    }

    public function getLibros() {
        return $this->libros;
    }

    public function getAutores() {
        return $this->autores;
    }

    public function getFavoritos() {
        return $this->favoritos;
    }

    public function getPrestamos() {
        return $this->prestamos;
    }

    public function getCategoriasFavoritasNombres() {
        $resultado = array();
        foreach ($this->categoriasFavoritas as $valor) {
            array_push($resultado, $valor[0]);
        }
        return $resultado;
    }

    public function getCategoriasFavoritasValores() {
        $resultado = array();
        foreach ($this->categoriasFavoritas as $valor) {
            array_push($resultado, $valor[1]);
        }
        return $resultado;
    }

    public function getLibrosLeidosNombres() {
        $resultado = array();
        foreach ($this->librosLeidos as $clave => $valor) {
            array_push($resultado, Funciones::getLabelMes($clave));
        }
        return $resultado;
    }

    public function getLibrosLeidosValores() {
        $resultado = array();
        foreach ($this->librosLeidos as $valor) {
            array_push($resultado, $valor);
        }
        return $resultado;
    }

}