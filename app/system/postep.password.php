<?php
define('system_app', true);
require '../../init.php';

if($app['pmc']['installed'] == false):

    if($post['password'] !== $post['confirm']):
        echo json_encode(array("success" => false, "message" => "The password confirmation does not match the main password"), true);
    elseif(!inputValid($post['password'], "password")):
        echo json_encode(array("success" => false, "message" => "There are characters not allowed in the password"), true);
    elseif(strlen($post['password']) < 8):
        echo json_encode(array("success" => false, "message" => "You must enter a password with at least 8 characters"), true);
    else:
        $ips=array();
        array_push($ips, remoteIP());
        
        $hashpass=encrypt($post['password']);

        $permissions=array();
        array_push($permissions, "users");
        array_push($permissions, "site");
        array_push($permissions, "router");
        array_push($permissions, "system");
        array_push($permissions, "mysql");
        array_push($permissions, "files");

        $_SESSION['step']=2;

        die(json_encode(
            ((new app)->edituser("admin", "admin", $hashpass, $permissions, $ips)) ?
            array("success" => true, "message" => "Usuario editado con éxito", "errorCode" => null) :
            array("success" => false, "message" => "No fue posible editar este usuario", "errorCode" => "FilePutError")
        ));

        
    endif;
    
else:
    echo json_encode(array("success" => false, "message" => "We are sorry! An installation has already been completed"), true);
endif;

?>

