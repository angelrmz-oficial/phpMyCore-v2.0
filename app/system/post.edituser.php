<?php require 'post.logged.php';

if(!in_array("users", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

if($post['user'] == "admin" && $userApp['username'] !== $post['user'])
  die(json_encode(array("success" => false, "message" => "No puedes editar este usuario", "errorCode" => "unauthorized")));

if($post['user'] == "admin" && $post['username'] !== "admin")
  die(json_encode(array("success" => false, "message" => "No puedes cambiar el nombre de este usuario", "errorCode" => "unauthorized")));


foreach ($app['users'] as $user)
  if($user['username'] == $post['username'] && $post['user'] != $post['username'])
    die(json_encode(array("success" => false, "message" => "Ya éxiste un usuario con este nombre", "errorCode" => "JsonKeyDuplicate")));

$ips=array();
foreach (explode(";", $post['ips']) as $ip)
  if(!inputValid($ip, 'ip'))
    die(json_encode(array("success" => false, "message" => "{$ip} no es una dirección IP válida ", "errorCode" => "InputValidError")));
  else
    array_push($ips, $ip);

if(!inputValid($post['username'], 'username'))
  die(json_encode(array("success" => false, "message" => "Nombre de usuario inválido", "errorCode" => "InputValidError")));

$hashpass="";

foreach ($app['users'] as $user):
  if($user['username'] == $post['username']):
    $selectUser=$user;
    if(!empty($post['password']) && !inputValid($post['password'], 'password')):
      die(json_encode(array("success" => false, "message" => "No puede usar esta contraseña porque demasiada rara", "errorCode" => "InputValidError")));
    elseif(!empty($post['password'])):
      $hashpass=encrypt($post['password']);
    else:
      $hashpass=$selectUser['hashpass'];
    endif;
  endif;
endforeach;


$permissions=array();
foreach ($post as $key => $value)
  if(strpos($key, 'permission_') !== false && $value == "on")
    array_push($permissions, str_replace('permission_', '', $key));
  elseif(strpos($key, 'permission_') !== false && $value == "off" && $post['user'] == "admin")
    die(json_encode(array("success" => false, "message" => "No se le puede quitar permisos a la cuenta administrador", "errorCode" => "InputValidError")));

die(json_encode(
  ((new app)->edituser($post['user'], $post['username'], $hashpass, $permissions, $ips)) ?
  array("success" => true, "message" => "Usuario editado con éxito", "errorCode" => null) :
  array("success" => false, "message" => "No fue posible editar este usuario", "errorCode" => "FilePutError")
));

?>