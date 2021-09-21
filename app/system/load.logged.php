<?php
define('system_app', true);
require '../../init.php';

if(!isset($_SESSION['app']))
  die("La sesión ha expirado");

foreach ($app['users'] as $user)
  if($user['username'] == $_SESSION['app'])
    $userApp=$user;

if(!isset($userApp))
  die("Usuario desautorizado");

?>
