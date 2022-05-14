<?php
namespace Clases\Utils;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EnvioEmail {
    public static function enviarEmail($asunto, $cuerpo){
        $mail = new PHPMailer(true);
        try {
            $config = Funciones::obtenerConfiguracion();
            //Server settings
            $mail->isSMTP();
            $mail->Host       = $config['email']['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['email']['username'];
            $mail->Password   = $config['email']['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['email']['port'];

            //Recipients
            $mail->setFrom($config['email']['username'], 'Bibliotech');
            $mail->addAddress($config['email']['receiver']);

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>