<?php
require_once '../vendor/autoload.php';

// Se elimina el usuario en sesión y se redirige al login
session_start();
unset($_SESSION['usuario']);
header("Location: index.php"); 
?>