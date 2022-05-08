<?php
namespace Clases;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EnvioEmail {
    public static function enviarEmail($asunto, $cuerpo){
        $mail = new PHPMailer(true);
        try {
            $config = parse_ini_file("../bibliotech.ini", true);
            //Server settings
            $mail->isSMTP();
            $mail->Host       = $config['email']['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['email']['username'];
            $mail->Password   = $config['email']['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['email']['port'];

            //Recipients
            $mail->setFrom('deveuge.dev@gmail.com', 'Bibliotech');
            $mail->addAddress('deveuge@gmail.com');

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