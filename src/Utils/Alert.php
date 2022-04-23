<?php
namespace Clases\Utils;

class Alert {
    private $mensaje;
    private $tipo;

    // Constructor
    public function __construct($m, $t){
        $this->mensaje = $m;
        $this->tipo = $t;
    }

    /* GETTERS */
    public function getMensaje() {
        return $this->mensaje;
    }

    public function getTipo() {
        return "alert-" . $this->tipo;
    }
}
?>