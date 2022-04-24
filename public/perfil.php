<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';
    require_once '../src/Utils/Jaxon.php';

    use Clases\Estadisticas;
    use Clases\Filtros\FiltroPrestamo;
    use Clases\Utils\Alert;
    use Clases\Usuario;
    use Clases\Libro;
    use Clases\Prestamo;
    use Clases\Utils\Paginacion;

    use Jaxon\Jaxon;
    use Jaxon\Response\Response;
    
    function cargarFavoritos($user, $page) {
        global $blade;
        $response = new Response();
        $favoritos = Libro::getFavoritos($user, $page);
        $viewRendered = $blade->view()->make('usuario/fragmentos/favoritos', compact('favoritos'))->render();
        $response->append('favoritos-resultados', 'innerHTML', $viewRendered);
        if(!Libro::getFavoritos($user, $page + 1)) {
            $response->remove('cargar-mas');
        }
        return $response;
    }

    function eliminarFavorito($isbn) {
        $response = new Response();
        Libro::eliminarFavorito($_SESSION['usuario']->getUsername(), $isbn);
        $response->remove('fav-' . $isbn);
        if(!Libro::getFavoritos($_SESSION['usuario']->getUsername(), 1)) {
            $response->remove('favoritos-resultados');
            $response->append('favoritos', 'innerHTML', '<p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>');
        }
        return $response;
    }

    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "cargarFavoritos");
    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "eliminarFavorito");
    if($jaxon->canProcessRequest()){
        $jaxon->processRequest();
    }

    if(!empty($_POST)) {
        $usuario = $_SESSION['usuario'];
        if($_POST['password'] != $_POST['repeat-password']) {
            $alertMessage = new Alert("Las contraseñas no coinciden", "danger");
        } else {
            $usuario->setNombre($_POST['nombre']);
            $usuario->setImagen($_POST['image']);
            if (!empty($_POST['password'])) {
                Usuario::updatePassword($usuario->getUsername(), $_POST['password']);
            }
            Usuario::updateUsuario($usuario);
            $_SESSION['usuario'] = $usuario;
            $alertMessage = new Alert("Datos actualizados correctamente", "success");
        }
        echo $blade->view()->make('usuario/editar', compact('usuario', 'alertMessage'))->render();
    } else {
        $usuario = $_SESSION['usuario'];
        if(isset($_GET["editar"])) {
            echo $blade->view()->make('usuario/editar', compact('usuario'))->render();
        } else {
            $filtro = new FiltroPrestamo($usuario->getUsername(), null, 1);
            $prestamos = Prestamo::list($filtro);
            $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
            $favoritos = Libro::getFavoritos($usuario->getUsername(), 1);
            $existenMasFavoritos = Libro::getFavoritos($usuario->getUsername(), 2);
            $estadisticas = Estadisticas::getEstadisitcas($usuario->getUsername());
            echo $blade->view()->make('usuario/ver', compact('usuario', 'prestamos', 'paginacion', 'favoritos', 'existenMasFavoritos', 'estadisticas', 'jaxon'))->render();
        }
    }

?>