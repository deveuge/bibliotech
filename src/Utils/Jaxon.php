<?php
    $jaxon = jaxon();
    $jaxon->setOption('js.app.minify', TRUE);
    $jaxon->setOption('js.lib.uri', '../vendor/jaxon-php/jaxon-js/dist');
    $jaxon->setOption('core.request.uri', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
?>