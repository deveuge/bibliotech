<?php
namespace Clases;
require_once '../vendor/autoload.php';
use Clases\Conexion;

class Categoria {
    private $id;
    private $nombre;
    private $imagen;

    public function __construct($id, $n, $i){
        $this->id = $id;
        $this->nombre = $n;
        $this->imagen = $i;
    }

    public static function list() {
        $categorias = array();
        $conexion = new Conexion();
        $listado = $conexion->getConexion()->query("SELECT * FROM category");
        while ($item = $listado->fetch()) {
            array_push($categorias, new Categoria(
                $item['id'],
                $item['name'],
                $item['image']
            ));
        }
        return $categorias;
    }

    /* GETTERS */
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getImagen() {
        return 'img/icons/' . $this->getImagenIndex() . '.png';
    }

    public function getImagenIndex() {
        return $this->imagen == null ? 0 : $this->imagen;
    }
}
?>