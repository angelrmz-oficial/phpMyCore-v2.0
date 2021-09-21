<?php require 'post.logged.php';
if(!in_array("router", $userApp['permissions']))
    die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));
elseif(!inputValid($post['templatename'], 'username'))
    die(json_encode(array("success" => false, "message" => "Ingresa un nombre de tema válido", "errorCode" => "InputValidError")));
elseif(file_exists(PATH_TPL . $post['templatename']))
    die(json_encode(array("success" => false, "message" => "Este nombre de tema no puede ser utilizado", "errorCode" => "FileExists")));
elseif(!(new app)->create_defaultpl($post['templatename']))
    die(json_encode(array("success" => false, "message" => "Algo paso mal...", "errorCode" => "AppError")));
else
    die(json_encode(array("success" => true, "message" => "Nuevo template agregado con éxito!", "errorCode" => "AppError")));