<?php
namespace Clases\Filtros;
use Clases\Utils\Paginacion;

class FiltroPrestamo {
    private $username;
    private $isbn;
    private $devuelto;
    private $fechaDevolucionDesde;
    private $fechaDevolucionHasta;
    private $ordenColumna;
    private $ordenDireccion;
    private $pagina;
    private $filas;

    public function __construct() {
        $num = func_num_args();
        $this->filas = Paginacion::ROWS_PER_PAGE;
        switch ($num) {
            case 1:
                $this->pagina = func_get_arg(0);
                break;
            // Filtro específico para el dashboard
            case 2:
                $this->username = func_get_arg(0);
                $this->devuelto = func_get_arg(1);
                $this->ordenColumna = 'assigned_return_date';
                $this->ordenDireccion = 'DESC';
                $this->pagina = 1;
                $this->filas = 4;
                break;
            case 3:
                $this->username = func_get_arg(0);
                $this->isbn = func_get_arg(1);
                $this->pagina = func_get_arg(2);
                break;
            case 8:
                $this->username = func_get_arg(0);
                $this->isbn = func_get_arg(1);
                $this->devuelto = func_get_arg(2);
                $this->fechaDevolucionDesde = func_get_arg(3);
                $this->fechaDevolucionHasta = func_get_arg(4);
                $this->ordenColumna = func_get_arg(5);
                $this->ordenDireccion = func_get_arg(6);
                $this->pagina = func_get_arg(7);
                break;
        }
    }

    public function getFiltroUsername() {
        if($this->username) {
            return "user_id = '" . $this->username . "'";
        }
        return '';
    }

    public function getFiltroIsbn() {
        if($this->isbn) {
            return "book_id = '" . $this->isbn . "'";
        }
        return '';
    }

    public function getFiltroDevuelto() {
        if($this->devuelto != null) {
            return "returned = " . $this->devuelto;
        }
        return '';
    }
    
    public function getFiltroFechaDevolucion() {
        $condicion = "";
        if($this->fechaDevolucionDesde) {
            $condicion += "assigned_return_date >= '" . date_create($this->fechaDevolucionDesde)->format('Y-m-d H:i:s') . "'";
        }
        if($this->fechaDevolucionHasta) {
            $condicion += "assigned_return_date <= '" . date_create($this->fechaDevolucionHasta)->format('Y-m-d H:i:s') . "'";
        }
        return $condicion;
    }

    public function hasFilter() {
        return $this->username || $this->isbn || $this->devuelto || $this->fechaDevolucionDesde || $this->fechaDevolucionHasta;
    }

    public function getFilterQuery() {
        $filtros = array();
        array_push($filtros, $this->getFiltroUsername());
        array_push($filtros, $this->getFiltroIsbn());
        array_push($filtros, $this->getFiltroDevuelto());
        array_push($filtros, $this->getFiltroFechaDevolucion());
        $filtros = array_filter($filtros, 'strlen');
        return implode(" AND ", $filtros);
    }
    
    public function getOrderQuery() {
        if($this->ordenColumna) {
            $direccion = $this->ordenDireccion ? $this->ordenDireccion : 'ASC';
            return <<<EOD
            ORDER BY $this->ordenColumna $direccion
            EOD;
        }
        return '';
    }
    
    public function getOrdenColumna() {
        return $this->ordenColumna;
    }

    public function getOrdenDireccion() {
        return $this->ordenDireccion;
    }

    public function getPagina() {
        return $this->pagina;
    }
 
    public function getFilas() {
        return $this->filas;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }
}
?>