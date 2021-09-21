<?php require 'post.logged.php'; 
if(!in_array("router", $userApp['permissions']))
    die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));
elseif(file_put_contents(PATH_TPL . $get['tpl'] .".zip", file_get_contents("php://input"))  === FALSE)
    die(json_encode(array("success" => false, "message" => "No fue posible subir este archivo", "errorCode" => "AppError")));
elseif(!(new app)->extractpl(PATH_TPL . $get['tpl'] .".zip", PATH_TPL . $get['tpl'] .DS))
    die(json_encode(array("success" => false, "message" => "No fue extraer este archivo", "errorCode" => "AppError")));
else
    die(json_encode(array("success" => true, "message" => "Plantilla instalada con éxito!", "errorCode" => "AppError")));

