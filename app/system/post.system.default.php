<?php require 'post.logged.php';
if(!in_array("system", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$post['system_phpv']="7.0";
$post['system_timezone']="America/Monterrey";
$post['system_charset']="UTF-8";
$post['system_mysqlcharset']="utf8";
$post['system_debug']="true";
$post['system_sessions']="off";
$post['system_apiSecurity']="on";

die(json_encode(
  ((new app)->settings($post)) ?
  array("success" => true, "message" => "Configuración del sistema restaurada!", "errorCode" => null) :
  array("success" => false, "message" => "No fue posible restaurar la configuración del sistema", "errorCode" => "FilePutError")
));

?>
