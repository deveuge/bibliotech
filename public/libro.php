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
        
        $filtro = new FiltroPrestamo(null, $libro->getIsbn(), 'assigned_return_date', 'ASC');
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
        $alertMessage = getAlertaSolicitudPrestamo();
        $alertMessage = getAlertaDevolucionPrestamo();
        $alertMessage = getAlertaLibro();

        if(isset($_GET["editar"])) {
            echo $blade->view()->make('libro/editar' , compact('libro', 'categorias'))->render();
        } else {
            $filtro = new FiltroPrestamo(null, $libro->getIsbn(), 'assigned_return_date', 'ASC');
            $prestamos = Prestamo::list($filtro);
            $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
            echo $blade->view()->make('libro/ver' , compact('libro', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
        }
    }

    function getAlertaSolicitudPrestamo() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(!isset($_GET["booked"])) {
            return null;
        }
        switch ($_GET["booked"]) {
            case 1:
                return new Alert("Solicitud de préstamo realizada correctamente.<br>Acuda a la biblioteca para recoger su ejemplar.", "success");
            case 2:
                return new Alert("No existen ejemplares disponibles para el préstamo.", "danger");
            case 3:
                return new Alert("Actualmente ya tiene este libro en préstamo.", "danger");
            case 4:
                return new Alert("No existe el libro solicitado.", "danger");
            default:
                return null;
        }
    }

    function getAlertaDevolucionPrestamo() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(!isset($_GET["returned"])) {
            return null;
        }
        switch ($_GET["returned"]) {
            case 1:
                return new Alert("Devolución realizada correctamente.", "success");
            case 2:
                return new Alert("El usuario no tiene actualmente el libro en préstamo.", "danger");
            case 3:
                return new Alert("No existe el libro solicitado.", "danger");
            default:
                return null;
        }
    }

    function getAlertaLibro() {
        global $alertMessage;
        if($alertMessage != null) {
            return $alertMessage;
        }
        if(isset($_GET["updated"])) {
            return new Alert("Libro actualizado correctamente", "success");
        }
        if(isset($_GET["created"])) {
            return new Alert("Libro registrado correctamente", "success");
        }
        return null;
    }

?>