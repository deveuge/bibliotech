<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

use Clases\Estadisticas;
use Clases\Filtros\FiltroPrestamo;
    use Clases\Utils\Alert;
    use Clases\Usuario;
    use Clases\Prestamo;
    use Clases\Utils\Paginacion;

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
            $estadisticas = Estadisticas::getEstadisitcas($usuario->getUsername());
            echo $blade->view()->make('usuario/ver', compact('usuario', 'prestamos', 'paginacion', 'estadisticas'))->render();
        }
    }
    
?>