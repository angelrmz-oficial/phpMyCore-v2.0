<?php require 'post.logged.php';
if(!in_array("router", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));
/*elseif(!inputValid($post['subtitle'], 'username'))
    die(json_encode(array("success" => false, "message" => "Ingresa una nombre de página válido", "errorCode" => "InputValidError")));*/
elseif(!(new app)->editroute($post))
    die(json_encode(array("success" => false, "message" => "Opps! Algo salio mal...", "errorCode" => "InputValidError")));
else 
    die(json_encode(array("success" => true, "message" => "Nueva ruta agregada con éxito!", "errorCode" => "InputValidError")));

