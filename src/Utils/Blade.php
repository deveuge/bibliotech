<?php
    use Philo\Blade\Blade;
    session_start();

    $views = '../views';
    $cache = '../cache';
    $blade = new Blade($views, $cache);

    // Comprobar que hay usuario autenticado si se accede a cualquier página que no sea el index
    if(basename($_SERVER['REQUEST_URI']) !== 'index.php') {
        if(!isset($_SESSION['usuario'])) {
            header("Location: index.php"); 
        }
    }
?>