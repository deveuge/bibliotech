<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

use Clases\Utils\Alert;
use Clases\Categoria;
use Clases\Filtros\FiltroPrestamo;
use Clases\Libro;
use Clases\Prestamo;
use Clases\Utils\Paginacion;

    $libro = new Libro();
    $categorias = Categoria::list();
    $alertMessage = null;

    if(!empty($_POST) && isset($_POST['accion'])) {
        $libro = new Libro (
            $_POST['isbn'],
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['cantidad'],
            new Categoria($_POST['categoria'], NULL, NULL),
            $_POST['paginas'],
            $_POST['fecha']
        );
        
        $filtro = new FiltroPrestamo(null, $libro->getIsbn(), '0', null, null, 'assigned_return_date', 'DESC', 1);
        $prestamos = Prestamo::list($filtro);
        $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
        
        switch($_POST['accion']) {
            // Nuevo libro
            case 'crear':
                if(Libro::findLibro($libro->getIsbn())) {
                    $alertMessage = new Alert("Ya existe un libro registrado con el ISBN " . $libro->getIsbn(), "danger");
                    $vista = 'libro/editar';
                    $_GET['crear'] = true;
                } else {
                    Libro::insertarLibro($libro);
                    $alertMessage = new Alert("Libro registrado correctamente", "success");
                    $vista = 'libro/ver';
                }
                echo $blade->view()->make($vista, compact('libro', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
                break;
            // Actualizar libro
            case 'modificar': 
                Libro::updateLibro($libro);
                $libro = Libro::findLibro($libro->getIsbn());
                $alertMessage = new Alert("Libro actualizado correctamente", "success");
                echo $blade->view()->make('libro/ver', compact('libro', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
                break;
        }
    }
    elseif(isset($_GET["crear"])) {
        echo $blade->view()->make('libro/editar', compact('libro', 'categorias'))->render();
    } else {
        $libro = Libro::findLibro($_GET["id"]);
        if(isset($_GET["editar"])) {
            echo $blade->view()->make('libro/editar' , compact('libro', 'categorias'))->render();
        } else {
            $filtro = new FiltroPrestamo(null, $libro->getIsbn(), '0', null, null, 'assigned_return_date', 'DESC', 1);
            $prestamos = Prestamo::list($filtro);
            $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
            echo $blade->view()->make('libro/ver' , compact('libro', 'categorias', 'prestamos', 'paginacion'))->render();
        }
    }

?>