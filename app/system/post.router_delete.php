<?php require 'post.logged.php';
if(!in_array("router", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));
elseif(!(new app)->deleteroute($post['route']))
    die(json_encode(array("success" => false, "message" => "Opps! Algo salio mal...", "errorCode" => "InputValidError")));
else 
    die(json_encode(array("success" => true, "message" => "Ruta eliminada con éxito!", "errorCode" => "InputValidError")));

