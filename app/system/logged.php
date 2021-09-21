<?php
define('system_app', true);
require '../../init.php';

if($app['pmc']['installed'] == false):
	header("Location: ". $current_url . "/app/system");
endif;

if(!isset($_SESSION['app']))
  redirect("app/system");

foreach ($app['users'] as $user)
  if($user['username'] == $_SESSION['app'])
    $userApp=$user;

if(!isset($userApp))
  redirect("app/system/logout.php");

?>
