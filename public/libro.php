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
            $_POST['fecha'],
            0
        );
        
        $filtro = new FiltroPrestamo(null, $libro->getIsbn(), '0', null, null, 'assigned_return_date', 'DESC', 1);
        $prestamos = Prestamo::list($filtro);
        $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
        $url = "Location: libro.php?id=" . $libro->getIsbn();
        
        switch($_POST['accion']) {
            // Nuevo libro
            case 'crear':
                if(Libro::findLibro($libro->getIsbn())) {
                    $alertMessage = new Alert("Ya existe un libro registrado con el ISBN " . $libro->getIsbn(), "danger");
                    $_GET['crear'] = true;
                    echo $blade->view()->make('libro/editar', compact('libro', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
                    break;
                } else {
                    Libro::insertarLibro($libro);
                    header($url . "&created=1");
                    break;
                }
            // Actualizar libro
            case 'modificar': 
                Libro::updateLibro($libro);
                header($url . "&updated=1");
                break;
        }
    }
    elseif(isset($_GET["crear"])) {
        echo $blade->view()->make('libro/editar', compact('libro', 'categorias'))->render();
    } else {
        $libro = Libro::findLibro($_GET["id"]);
        if(isset($_GET["booked"])) {
            switch ($_GET["booked"]) {
                case 1:
                    $alertMessage = new Alert("Solicitud de préstamo realizada correctamente.<br>Acuda a la librería para recoger su ejemplar.", "success");
                    break;
                case 2:
                    $alertMessage = new Alert("No existen ejemplares disponibles para el préstamo.", "danger");
                    break;
                case 3:
                    $alertMessage = new Alert("Actualmente ya tiene este libro en préstamo.", "danger");
                    break;
                case 4:
                    $alertMessage = new Alert("No existe el libro solicitado.", "danger");
                    break;
            }
        }
        if(isset($_GET["updated"])) {
            $alertMessage = new Alert("Libro actualizado correctamente", "success");
        }
        if(isset($_GET["created"])) {
            $alertMessage = new Alert("Libro registrado correctamente", "success");
        }
        if(isset($_GET["editar"])) {
            echo $blade->view()->make('libro/editar' , compact('libro', 'categorias'))->render();
        } else {
            $filtro = new FiltroPrestamo(null, $libro->getIsbn(), '0', null, null, 'assigned_return_date', 'DESC', 1);
            $prestamos = Prestamo::list($filtro);
            $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
            echo $blade->view()->make('libro/ver' , compact('libro', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
        }
    }

?>