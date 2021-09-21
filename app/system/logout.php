<?php
define('system_app', true);
require '../../init.php';

if(isset($_SESSION['app']))
  unset($_SESSION['app']);

redirect("app/system/index.php");
?>
