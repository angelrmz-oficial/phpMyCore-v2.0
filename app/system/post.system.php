<?php require 'post.logged.php';
if(!in_array("system", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

if(isset($post['system_phpv']) && !in_array($post['system_phpv'], array("5.3","5.4","5.5", "5.6", "7.0", "7.1", "7.2", "7.3")))
  die(json_encode(array("success" => false, "message" => "Ingresa una versión de PHP válida", "errorCode" => "unauthorized")));

if(isset($post['system_sessions']) && $post['system_sessions'] == "on" && site_baseurl == "localhost")
  die(json_encode(array("success" => false, "message" => "No puedes usar sesiones en cookies en localhost", "errorCode" => "unauthorized")));

die(json_encode(
  ((new app)->settings($post)) ?
  array("success" => true, "message" => "Configuración actualizada!", "errorCode" => null) :
  array("success" => false, "message" => "No fue posible actualizar la configuración del sistema", "errorCode" => "FilePutError")
));

?>
