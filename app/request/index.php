<?php

function RequestLog($log){
  die($log);
}

//!isset($_GET['requestype']) || empty($_GET['requestype'] || basename($_SERVER['PHP_SELF']) == basename(__FILE__)
if(!isset($_GET['requestype']) || !($_GET['requestype'] == "api" || $_GET['requestype'] == "ws"))
  RequestLog("Acceso denegado");

define('system_apiMode', true);

if($_GET['requestype'] == "ws")
  define('system_webscr', true);

require '../../init.php';

define('REQUEST_DIR', __DIR__ . DS . $get['requestype'] . DS);//dirname(__FILE__)

return ($get['requestype'] == "api") ? new WebApiRest : new WebService(true);

?>
