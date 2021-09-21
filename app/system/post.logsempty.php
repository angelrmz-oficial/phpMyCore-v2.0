<?php require 'post.logged.php';
if(!in_array("system", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$app['logs']=array();
if(file_put_contents(PATH_EXTRADATA . 'app.logs.json', $app['logs']) === FALSE)
  die(json_encode(array("success" => false, "message" => "Algo salio mal...", "errorCode" => "FilePutError")));

die(json_encode(array("success" => true, "message" => "Registro de errores limpiados con éxito!", "errorCode" => null)));

?>
