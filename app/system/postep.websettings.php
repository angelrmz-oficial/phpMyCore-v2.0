<?php
define('system_app', true);
require '../../init.php';

if($app['pmc']['installed'] == false):

    die(json_encode(
        ((new app)->settings($post)) ?
        array("success" => true, "message" => "Configuración actualizada!", "errorCode" => null) :
        array("success" => false, "message" => "No fue posible actualizar la configuración del sistema", "errorCode" => "FilePutError")
    ));

else:
    echo json_encode(array("success" => false, "message" => "We are sorry! An installation has already been completed"), true);
endif;

?>

