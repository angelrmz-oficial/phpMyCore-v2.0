<?php require 'post.logged.php'; $tpls=array_diff(scandir(PATH_TPL), array('..', '.')); 
if(!in_array("router", $userApp['permissions']))
    die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));
elseif($post['template'] == "default" || count($tpls) < 2 || $post['template'] == site_theme)
    die(json_encode(array("success" => false, "message" => "No puedes eliminar un template defecto", "errorCode" => "AppError")));
elseif(rrmdir(PATH_TPL . $post['template']))
    die(json_encode(array("success" => false, "message" => "Algo paso mal...", "errorCode" => "AppError")));
else
    die(json_encode(array("success" => true, "message" => "Template borrado con éxito!", "errorCode" => "")));