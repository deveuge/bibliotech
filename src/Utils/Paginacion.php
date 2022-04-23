<?php
namespace Clases\Utils;

class Paginacion {
	private $totalPaginas;
    private $totalRegistros;
	private $actual;
	private $paginas;

    private const VISIBLE_PAGES = 3;
    public const ROWS_PER_PAGE = 10;

    public function __construct($totalRegistros, $actual){
		$this->paginas = array();
		$this->totalRegistros = $totalRegistros;
		$this->totalPaginas = ceil($totalRegistros / Paginacion::ROWS_PER_PAGE);
		$this->actual = $actual;
		
		$from = $actual - (Paginacion::VISIBLE_PAGES / 2);
        $to = $actual + (Paginacion::VISIBLE_PAGES / 2);

        if ($from < 1) {
            $from = 1;
            $to = $this->totalPaginas < Paginacion::VISIBLE_PAGES ? $this->totalPaginas : Paginacion::VISIBLE_PAGES;
        }
        if ($to > $this->totalPaginas) {
            $from = ($this->totalPaginas - Paginacion::VISIBLE_PAGES) < 1 ? 1 : $this->totalPaginas - (Paginacion::VISIBLE_PAGES - 1);
            $to = $this->totalPaginas;
        }
		
		for($i = $from; $i <= $to; $i++) {
			array_push($this->paginas, $i);
		}
    }

	public function getActual() {
		return $this->actual;
	}

	public function getPaginas() {
		return $this->paginas;
	}

    public function isFirst() {
        return $this->actual == 1;
    }

    public function isLast() {
        return $this->actual == $this->totalPaginas;
    }

	public function getTotalPaginas() {
		return $this->totalPaginas;
	}

    public function getTotalRegistros() {
        return $this->totalRegistros;
    }
}