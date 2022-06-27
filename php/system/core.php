<?php

if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

if($app['pmc']['installed'] == false && !defined('system_app')):
    header("Location: ". $current_url . $_SERVER['REQUEST_URI'] . "/app/system/");
elseif(site_redirect && site_url !== $current_url && !defined('system_app')):
    header("Location: ".site_url . $_SERVER['REQUEST_URI']);
    //redirct($_SERVER['REQUEST_URI']);
endif;

if(isset($_POST['action'])  && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'): //&& que venga de mi sitio

  if(domain($URLRequest) !== domain($URLAuthorized)):
    error_logs("$URLRequest  not authorized for this request");
  elseif(empty($_POST['action'])):
    error_logs("PostBack action is empty");
  else:

    $posted['success']=false;
    $posted['message']="";

    $file=PATH_POSTBACK . $_POST['action'] .'.php';

    (file_exists($file)) ? require $file : error_logs("No existe el archivo postback: ". $_POST['action']);
  endif;
  //unset($_POST);
endif;

?>
