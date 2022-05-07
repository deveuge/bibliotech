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
    private $disponibles;

    public function __construct() {
        $num = func_num_args();
        switch ($num) {
            case 4:
                $this->isbn = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->autor = func_get_arg(2);
                $this->descripcion = func_get_arg(3);
                break;
            case 10:
                $this->isbn = func_get_arg(0);
                $this->nombre = func_get_arg(1);
                $this->autor = func_get_arg(2);
                $this->descripcion = func_get_arg(3);
                $this->precio = func_get_arg(4);
                $this->cantidad = func_get_arg(5);
                $this->categoria = func_get_arg(6);
                $this->paginas = func_get_arg(7);
                $this->fechaPublicacion = func_get_arg(8);
                $this->disponibles = func_get_arg(9);
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
                $resultado['publish_date'],
                $resultado['availables']
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
            SELECT b.*, c.name AS category_name, 
            b.quantity - (SELECT COUNT(*) FROM lending WHERE book_id = b.ISBN and returned = 0) AS availables  
            FROM book b JOIN category c ON b.category_id = c.id 
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
        $stmt = $conexion->getConexion()->prepare(
            <<<EOD
            SELECT b.*, c.name AS category_name, 
            b.quantity - (SELECT COUNT(*) FROM lending WHERE book_id = b.ISBN and returned = 0) AS availables 
            FROM book b JOIN category c ON b.category_id = c.id WHERE isbn = ?
            EOD);
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
            $resultado['publish_date'],
            $resultado['availables']
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
        $stmt = $conexion->getConexion()->prepare("INSERT INTO book VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $libro->getIsbn(),
            $libro->getAutor(),
            $libro->getNombre(),
            $libro->getDescripcion(),
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

    public static function eliminarLibro($isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("DELETE FROM book WHERE isbn = ?");
        $stmt->execute([$isbn]);
    }

    public static function esFavorito($user, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("SELECT 1 FROM favorite WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$user, $isbn]);
        return $stmt->rowCount();
    }

    public static function agregarFavorito($user, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("INSERT INTO favorite VALUES (?, ?)");
        $stmt->execute([$user, $isbn]);
    }

    public static function eliminarFavorito($user, $isbn) {
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare("DELETE FROM favorite WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$user, $isbn]);
    }

    public static function getFavoritos($user, $page) {
        $libros = array();
        $filas = 4;
        $offset = ($page - 1) * $filas;
        $conexion = new Conexion();
        $stmt = $conexion->getConexion()->prepare(
            <<<EOD
            SELECT ISBN, name, author, description FROM book b JOIN favorite f ON b.ISBN = f.book_id WHERE f.user_id = ? 
            LIMIT $filas OFFSET $offset
            EOD
        );
        $stmt->execute([$user]);
        while ($resultado = $stmt->fetch()) {
            array_push($libros, new Libro(
                $resultado['ISBN'],
                $resultado['name'],
                $resultado['author'],
                $resultado['description']
            ));
        }
        return $libros;
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
        return number_format($this->precio, 2, '.', '');
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

    public function getDisponibles() {
        return $this->disponibles;
    }
}

?>