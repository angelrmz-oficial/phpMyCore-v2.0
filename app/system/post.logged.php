<?php
define('system_app', true);
require '../../init.php';

if(!isset($_SESSION['app']))
  die(json_encode(array("success" => false, "message" => "La sesión ha expirado", "errorCode" => "SessionExpired")));

foreach ($app['users'] as $user)
  if($user['username'] == $_SESSION['app'])
    $userApp=$user;

if(!isset($userApp))
  die(json_encode(array("success" => false, "message" => "Usuario desautorizado", "errorCode" => "unauthorized")));

?>
