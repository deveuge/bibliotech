<?php
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

    $jaxon = jaxon();
    $jaxon->setOption('js.app.minify', TRUE);
    $jaxon->setOption('js.lib.uri', '../vendor/jaxon-php/jaxon-js/dist');
    $jaxon->setOption('core.request.uri', $escaped_url);
?>