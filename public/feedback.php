<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

    use Clases\Utils\EnvioEmail;
    use Clases\Utils\Alert;

    YsJQueryAutoloader::register();
    YsJQuery::usePlugin(YsJQueryConstant::PLUGIN_JQVALIDATE);

    $alertMessage = null;

    if(!empty($_POST)) {
        // Revisión de campos obligatorios
        if(empty($_POST['tipo']) || empty($_POST['asunto']) || empty($_POST['mensaje'])) {
            $alertMessage = new Alert("Por favor, rellene todos los campos obligatorios", "danger");
        }
        // Envío de email al administrador con el feedback del usuario
        else {
            $tipo = $_POST['tipo'];
            $asunto = $_POST['asunto'];
            $envioCorrecto = EnvioEmail::enviarEmail(
                "[Bibliotech][$tipo] - $asunto",
                construirCuerpoEmail()
            );
            if($envioCorrecto) {
                $alertMessage = new Alert("Mensaje enviado correctamente", "success");
            } else {
                $alertMessage = new Alert("Ha ocurrido un problema al intentar enviar su mensaje", "danger");
            }
        }
    }

    // Generación del cuerpo del email con la plantilla html y los datos del usuario
    function construirCuerpoEmail() {
        $filename = "emailTemplate.html";
        $file = fopen($filename, "r");
        $filesize = filesize($filename);
        $filetext = fread($file, $filesize);
        fclose($file);

        $usuario = $_SESSION['usuario'];
        $cuerpo = str_replace("[nombre_usuario]", $usuario->getNombre(), $filetext);
        $cuerpo = str_replace("[email_usuario]", $usuario->getEmail(), $cuerpo);
        $cuerpo = str_replace("[tipo_mensaje]", $_POST['tipo'], $cuerpo);
        $cuerpo = str_replace("[asunto_mensaje]", $_POST['asunto'], $cuerpo);
        $cuerpo = str_replace("[cuerpo_mensaje]", $_POST['mensaje'], $cuerpo);
        $cuerpo = str_replace("[satisfaccion_mensaje]", construirEmojiSatisfaccion(), $cuerpo);
        return $cuerpo;
    }

    // Generación del emoji a imprimir en el email según el grado de satisfacción del usuario
    function construirEmojiSatisfaccion() {
        $satisfaccion = isset($_POST['satisfaccion']) ? $_POST['satisfaccion'] : 0;
        $emoji = "No especificado";
        switch($satisfaccion) {
            case 1:
                $emoji = "&#128544;";
                break;
            case 2:
                $emoji = "&#128577;";
                break;
            case 3:
                $emoji = "&#128528;";
                break;
            case 4:
                $emoji = "&#128578;";
                break;
            case 5:
                $emoji = "&#128515;";
                break;
        }
        return "$emoji - ($satisfaccion)";
    }

    echo $blade->view()->make('feedback', compact('alertMessage'))->render();
?>