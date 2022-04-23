<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';
    use Clases\Libro;
    use Clases\Categoria;
    use Clases\Filtros\FiltroPrestamo;
    use Clases\Prestamo;

    $usuario = $_SESSION['usuario'];
    $librosTotal = Libro::countAll();
    $ultimosLibros = Libro::findUltimosLibros();
    $categorias = Categoria::list();
    $prestamos = Prestamo::list(new FiltroPrestamo($usuario->getUsername(), '0'));
    
    echo $blade->view()->make('dashboard', compact('librosTotal', 'ultimosLibros', 'categorias', 'prestamos'))->render();
?>