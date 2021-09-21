<?php
define('system_app', true);
require '../../init.php';

if($app['pmc']['installed'] == false):
    die(json_encode(
        ((new app)->pmc("installed", true)) ?
        array("success" => true, "message" => "Instalación finalizada!", "errorCode" => null) :
        array("success" => false, "message" => "No fue posible finalizar la instalación", "errorCode" => "FilePutError")));
else:
    echo json_encode(array("success" => false, "message" => "We are sorry! An installation has already been completed"), true);
endif;

?>

