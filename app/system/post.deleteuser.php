<?php require 'post.logged.php';
if(!in_array("users", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

if($post['username'] == $_SESSION['app'] || $post['username'] == "admin")
  die(json_encode(array("success" => false, "message" => "No puedes eliminar este usuario", "errorCode" => "unauthorized")));

die(json_encode(
  ((new app)->deleteuser($post['username'])) ?
  array("success" => true, "message" => "Usuario eliminado!", "errorCode" => null) :
  array("success" => false, "message" => "No fue posible eliminar este usuario del sistema", "errorCode" => "FilePutError")
));

?>
