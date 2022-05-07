<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';
    use Clases\Usuario;
    use Clases\Utils\Alert;

    $alertMessage = null;
    $mostrarRegistro = null;

    if(!empty($_POST) && isset($_POST['accion'])) {
        switch($_POST['accion']) {
            // Realizar login
            case 'login':
                $usuario = Usuario::findUsuario($_POST['l-usuario'], $_POST['l-password']);
                $usuario 
                    ? $_SESSION['usuario'] = $usuario
                    : $alertMessage = new Alert("Login incorrecto, revise sus credenciales e inténtelo de nuevo", "danger");
                break;
            // Realizar registro
            case 'register':
                if($_POST['r-password'] != $_POST['r-password-repeat']) {
                    $alertMessage = new Alert("Las contraseñas no coinciden", "danger");
                }
                if(Usuario::existeUsuarioPorUsername($_POST['r-usuario'])) {
                    $alertMessage = new Alert("Ya existe un usuario registrado con ese nombre de usuario", "danger");
                }
                if(Usuario::existeUsuarioPorEmail($_POST['r-email'])) {
                    $alertMessage = new Alert("Ya existe un usuario registrado con ese email", "danger");
                }
                if($alertMessage != null) {
                    $mostrarRegistro = true;
                    break;
                }
                Usuario::insertarUsuario($_POST['r-usuario'], $_POST['r-email'], $_POST['r-password']);
                $alertMessage = new Alert("Usuario creado correctamente, ya puede iniciar sesión", "success");
                break;
        }
    }
    
    // Si existe usuario logueado, redirigir al dashboard
    if(isset($_SESSION['usuario'])) {
        header("Location: dashboard.php"); 
    }

    echo $blade->view()->make('index', compact('alertMessage', 'mostrarRegistro'))->render();
?>