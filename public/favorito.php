<?php
    require_once '../vendor/autoload.php';
    session_start();

    use Clases\Libro;

    if(!empty($_POST) && isset($_POST['accion'])) {
        switch($_POST['accion']) {
            case "agregar":
                Libro::agregarFavorito($_SESSION['usuario']->getUsername(), $_POST['isbn']);
                break;
            case "eliminar":
                Libro::eliminarFavorito($_SESSION['usuario']->getUsername(), $_POST['isbn']);
                break;
        }
        header("Location: libro.php?id=" . $_POST['isbn']); 
    }

?>