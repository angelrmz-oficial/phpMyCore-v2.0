<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

require 'authy/autoload.php';

class authy
{

  function __construct()
  {
    $this->authy = new Authy\AuthyApi((new webcfg)->cfg('authy_api_key'));
  }

  function verify($token, $authy_id){
    $verification = $this->authy->verifyToken($authy_id, $token);
    $success=$verification->ok();
    $message=($success) ? "Token válido" : "Token inválido";
    return array("message" => $message, "success" => $success);
  }

  function register($correo, $numero){
    $user = $this->authy->registerUser($correo, $numero, 52); //email, cellphone, country_code
    return array("success" => $user->ok(), "id" => $user->id());
  }

}

?>
