<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

    echo $blade->view()->make('about')->render();
?>