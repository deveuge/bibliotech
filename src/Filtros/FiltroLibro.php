<?php
namespace Clases\Filtros;
use Clases\Utils\Paginacion;

class FiltroLibro {
    private $texto;
    private $categoria;
    private $soloDisponibles;
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
            case 6:
                $this->texto = func_get_arg(0);
                $this->categoria = func_get_arg(1);
                $this->soloDisponibles = func_get_arg(2);
                $this->ordenColumna = func_get_arg(3);
                $this->ordenDireccion = func_get_arg(4);
                $this->pagina = func_get_arg(5);
                break;
        }
    }

    public function getFiltroTexto() {
        if($this->texto) {
            return <<<EOD
            (ISBN LIKE '%$this->texto%' OR author LIKE '%$this->texto%' OR b.name LIKE '%$this->texto%')
            EOD;
        }
        return '';
    }

    public function getFiltroCategoria() {
        if($this->categoria) {
            return "c.id = " . $this->categoria;
        }
        return '';
    }
    
    public function getFiltroSoloDisponibles() {
        if($this->soloDisponibles) {
            // TODO:
            return '';
        }
        return '';
    }

    public function hasFilter() {
        return $this->texto || $this->categoria || $this->soloDisponibles;
    }

    public function getFilterQuery() {
        $filtros = array();
        array_push($filtros, $this->getFiltroTexto());
        array_push($filtros, $this->getFiltroCategoria());
        array_push($filtros, $this->getFiltroSoloDisponibles());
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
    
    public function getTexto() {
        return $this->texto;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getSoloDisponibles() {
        return $this->soloDisponibles;
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