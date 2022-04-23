<?php
    require_once '../vendor/autoload.php';
    session_start();

    use Clases\Libro;
    use Clases\Prestamo;

    $isbn = $_POST['isbn'];
    $url = "Location: libro.php?id=" . $isbn . "&booked=";
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
?>