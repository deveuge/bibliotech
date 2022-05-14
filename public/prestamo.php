<?php
    require_once '../vendor/autoload.php';
    session_start();

    use Clases\Libro;
    use Clases\Prestamo;
    use Clases\Utils\Funciones;

    // Realizar solicitud o devolución de un préstamo
    if(!empty($_POST) && isset($_POST['accion'])) {
        switch($_POST['accion']) {
            case "solicitar-catalogo":
                $url = "Location: catalogo.php?booked=";
                realizarSolicitud();
                break;
            case "solicitar":
                $url = "Location: libro.php?id=" . $_POST['isbn'] . "&booked=";
                realizarSolicitud();
                break;
            case "devolver-perfil":
                Funciones::comprobarAccesoModerador();
                realizarDevolucion();
                header("Location: perfil.php?id=" . $_POST['user'] . "&returned=" . 1); 
                break;
            case "devolver":
                Funciones::comprobarAccesoModerador();
                realizarDevolucion();
                header("Location: libro.php?id=" . $_POST['isbn'] . "&returned=" . 1); 
                break;
        }
    }

    // Realizar la solicitud de un préstamo
    function realizarSolicitud() {
        global $url;
        $isbn = $_POST['isbn'];
        $libro = Libro::findLibro($isbn);
        // Comprobar si existe el libro
        if(!$libro) {
            return header($url . 4);
        }
        // Comprobar si existen ejemplares disponibles
        if($libro->getDisponibles() == 0) {
            return header($url . 2);
        }
        // Comprobar si el usuario tiene el libro ya en préstamo
        if(Prestamo::existePrestamoActivo($_SESSION['usuario']->getUsername(), $isbn)) {
            return header($url . 3);
        }
        // Guardar préstamo
        Prestamo::insertarPrestamo($_SESSION['usuario']->getUsername(), $isbn);
        header($url . 1); 
    }

    // Realizar la devolución de un préstamo
    function realizarDevolucion() {
        $isbn = $_POST['isbn'];
        $user = $_POST['user'];
        $url = "Location: libro.php?id=" . $isbn . "&returned=";
        $libro = Libro::findLibro($isbn);
        // Comprobar si existe el libro
        if(!$libro) {
            return header($url . 3);
            exit();
        }
        // Comprobar si el usuario tiene el libro ya en préstamo
        if(!Prestamo::existePrestamoActivo($user, $isbn)) {
            return header($url . 2);
            exit();
        }
        // Guardar préstamo
        Prestamo::devolverPrestamo($user, $isbn);
    }
?>