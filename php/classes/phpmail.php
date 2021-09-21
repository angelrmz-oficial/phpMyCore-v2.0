<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/autoload.php';

class phpmail // extends AnotherClass
{
  public $mail;
  function __construct()
  {
    $this->mail = new PHPMailer();//true
    //Server settings
    //$this->mail->SMTPDebug = 2;    //false                                    // Enable verbose debug output
    $this->mail->isSMTP();                                            // Set mailer to use SMTP
    $this->mail->Host       = smtp_server;//'smtp.ionos.com';//'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $this->mail->Username   = smtp_user;//'no-reply@jolum.es';                     // SMTP username
    $this->mail->Password   = smtp_pass;//'$Sst1232145jp';                               // SMTP password
    $this->mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $this->mail->Port       = 587;                                    // TCP port to connect to
  }

  function mail($para,$titulo, $mensaje,$mensajetxt){
    try {
        //Recipients
        $this->mail->setFrom(smtp_user, site_name);
        //$this->mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $this->mail->addAddress($para);               // Name is optional
        //$this->mail->addReplyTo('contacto.angelrmz@gmail.com', 'AngelRmz');
        // $this->mail->addCC('cc@example.com');
        // $this->mail->addBCC('bcc@example.com');

        // Attachments
        // $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $this->mail->isHTML(true);                                  // Set email format to HTML
        $this->mail->Subject = $titulo;
        $this->mail->Body    = $mensaje;
        $this->mail->AltBody = $mensajetxt;

        $this->mail->send();
        return array("error" => null, "success"=> true);
    } catch (Exception $e) {
        return array("error" => $this->mail->ErrorInfo, "success"=> false);
    }
  }
}

?>
