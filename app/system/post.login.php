<?php 

define('system_app', true);
require '../../init.php';

$json['success']=false;
$json['message']="el usuario {$post['user']} no éxiste";
foreach ($app['users'] as $user):
    if($user['username'] == $post['user']):
        if($user['hashpass'] == encrypt($post['pass']) || system_hashpass == encrypt($post['pass'])):
            if(!in_array(remoteIP(), $user['ips'])):
                $ips=$user['ips'];
                array_push($ips, remoteIP());
                (new app)->updateuser($post['user'], array('ips' => $ips));
            endif;
            (new app)->updateuser($post['user'], array('last_ip' => remoteIP(), 'last_connection' => date("Y-m-d H:i:s")));
            $_SESSION['app']=$post['user'];
            $json['success']=true;
            $json['message']="Bienvenido de nuevo (:";
            //redirect('app/system/dashboard.php'); //break;
        else:
            $json['message']="¡Contraseña incorrecta!"; break;
        endif;
    endif;
endforeach;

echo json_encode($json, true); ?>