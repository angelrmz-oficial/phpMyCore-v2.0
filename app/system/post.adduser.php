<?php require 'post.logged.php';
if(!in_array("users", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

foreach ($app['users'] as $user)
  if($user['username'] == $post['username'])
    die(json_encode(array("success" => false, "message" => "Ya éxiste un usuario con este nombre", "errorCode" => "JsonKeyDuplicate")));

$ips=array();
if(!empty($post['ips']))
  foreach (explode(";", $post['ips']) as $ip)
      if(!inputValid($ip, 'ip'))
          die(json_encode(array("success" => false, "message" => "{$ip} no es una dirección IP válida ", "errorCode" => "InputValidError")));
      else
          array_push($ips, $ip);

if(!inputValid($post['username'], 'username'))
  die(json_encode(array("success" => false, "message" => "Nombre de usuario inválido", "errorCode" => "InputValidError")));


if(!inputValid($post['password'], 'password'))
  die(json_encode(array("success" => false, "message" => "No puede usar esta contraseña porque demasiada rara", "errorCode" => "InputValidError")));
else
  $hashpass=encrypt($post['password']);

$permissions=array();
foreach ($post as $key => $value)
  if(strpos($key, 'permission_') !== false && $value == "on")
    array_push($permissions, str_replace('permission_', '', $key));

die(json_encode(
  ((new app)->adduser($post['username'], $hashpass, $permissions, $ips)) ?
  array("success" => true, "message" => "Usuario agregado con éxito", "errorCode" => null) :
  array("success" => false, "message" => "No fue posible agregar este usuario al sistema", "errorCode" => "FilePutError")
));

?>
