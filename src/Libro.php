<?php
namespace Clases;
require_once '../vendor/autoload.php';
use Clases\Conexion;

class Libro {
    private $isbn;
    private $nombre;
    private $autor;
    private $descripcion;
    private $precio;
    private $cantidad;
    private $categoria;
    private $paginas;
    private $fechaPublicacion;

    public function __construct() {
        $num = func_num_args();
        switch ($num) {
            case 4:
                $this->isbn = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->autor = func_get_arg(2);
                $this->descripcion = func_get_arg(3);
                break;
            case 9:
                $this->isbn = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->autor = func_get_arg(2);
                $this->descripcion = func_get_arg(3);
                $this->precio = func_get_arg(4);
                $this->cantidad = func_get_arg(5);
                $this->categoria = func_get_arg(6);
                $this->paginas = func_get_arg(7);
                $this->fechaPublicacion = func_get_arg(8);
                break;
        }
    }

    public static function list($filtro) {
        $libros = array();
        $conexion = new Conexion();

        $stmt = $conexion->getConexion()->prepare(Libro::construirQuery($filtro));
        $stmt->execute();
        while ($resultado = $stmt->fetch()) {
            array_push($libros, new Libro(
                $resultado['ISBN'],
                $resultado['name'],
                $resultado['author'],
                $resultado['description'],
                $resultado['price'],
                $resultado['quantity'],
                new Categoria(
                    $resultado['category_id'],
                    $resultado['category_name'],
                    NULL
                ),
                $resultado['pages'],
                $resultado['publish_date']
            ));
        }
        return $libros;
    }

    private static function construirQuery($filter) {
        $agregarWhere = $filter->hasFilter() ? " WHERE " : "";
        $agregarFiltros = $filter->getFilterQuery();
        $agregarOrden = $filter->getOrderQuery();
        $filas = $filter->getFilas();
        $offset = ($filter->getPagina() - 1) * $filas;
        return <<<EOD
            SELECT b.*, c.name AS category_name FROM book b JOIN category c ON b.category_id = c.id 
            $agregarWhere $agregarFiltros $agregarOrden
            LIMIT $filas OFFSET $offset
        EOD;
    }
    
    public static function countAll() {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->query("SELECT COUNT(*) FROM book");
        return $stmt->fetch()[0];
    }

    
    public static function countList($filtro) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->query(Libro::construirQueryCount($filtro));
        return $stmt->fetch()[0];
    }
    
    private static function construirQueryCount($filter) {
        $agregarWhere = $filter->hasFilter() ? " WHERE " : "";
        $agregarFiltros = $filter->getFilterQuery();
        return <<<EOD
            SELECT COUNT(*) FROM book b JOIN category c ON b.category_id = c.id 
            $agregarWhere $agregarFiltros
        EOD;
    }
    
    public static function findLibro($isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT b.*, c.name AS category_name FROM book b JOIN category c ON b.category_id = c.id WHERE isbn = ?");
        $stmt->execute([$isbn]);
        $resultado = $stmt->fetch();
        if($resultado == null) {
            return null;
        }
        return new Libro(
            $resultado['ISBN'],
            $resultado['name'],
            $resultado['author'],
            $resultado['description'],
            $resultado['price'],
            $resultado['quantity'],
            new Categoria(
                $resultado['category_id'],
                $resultado['category_name'],
                NULL
            ),
            $resultado['pages'],
            $resultado['publish_date']
        );
    }

    public static function findUltimosLibros() {
        $libros = array();
        $conexion = new Conexion();
        $listado = $conexion->getConexion()->query("SELECT * FROM book ORDER BY created_at DESC LIMIT 7");
        while ($item = $listado->fetch()) {
            array_push($libros, new Libro(
                $item['ISBN'],
                $item['name'],
                $item['author'],
                $item['description']
            ));
        }
        return $libros;
    }

    public static function insertarLibro($libro) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("INSERT INTO book VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $libro->getIsbn(),
            $libro->getAutor(),
            $libro->getNombre(),
            $libro->getPrecio(),
            $libro->getCantidad(),
            $libro->getCategoria()->getId(),
            $libro->getPaginas(),
            $libro->getFechaPublicacionInput(),
            NULL,
            date_create()->format('Y-m-d H:i:s')
        ]);
    }

    public static function updateLibro($libro) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("UPDATE book SET name = ?, author = ?, description = ?, price = ?, quantity = ?, category_id = ?, pages = ?, publish_date = ?, modified_at = ? WHERE isbn = ?");
        $stmt->execute([
            $libro->getNombre(),
            $libro->getAutor(),
            $libro->getDescripcion(),
            $libro->getPrecio(),
            $libro->getCantidad(),
            $libro->getCategoria()->getId(),
            $libro->getPaginas(),
            $libro->getFechaPublicacionInput(),
            date_create()->format('Y-m-d H:i:s'),
            $libro->getIsbn()
        ]);
    }

    /* GETTERS */
    public function getIsbn() {
        return $this->isbn;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getPaginas() {
        return $this->paginas;
    }

    public function getFechaPublicacion() {
        return date_create($this->fechaPublicacion)->format('d/m/Y');
    }

    public function getFechaPublicacionInput() {
        if(!$this->fechaPublicacion) {
            return '';
        }
        return date_create($this->fechaPublicacion)->format('Y-m-d');
    }
}

?>