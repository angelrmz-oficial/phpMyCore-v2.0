<?php

if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

// ini_set('memory_limit', '256M');

ini_set("display_errors", system_debug);
ini_set("error_reporting", system_debug);
ini_set('short_open_tags', 'On');//short_open_tag (system_debug) ? 'On' : 'Off');
ini_set('default_charset', system_charset);
date_default_timezone_set(system_timezone);
define('system_date', date("Y-M-d H:i:s"));

define('USER_LANG', @substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

// if !defined webscr
// if(error_get_last()) error_logs();
//
// (version_compare(PHP_VERSION, system_phpv) > 0) ?:
  // error_logs('CodeBridge Framework requires PHP '.system_phpv.' or greater.');

# Debug mode
if(system_debug && !defined('system_webscr') && !defined('system_app')):
  if(in_array(remoteIP(), system_devIPs)):
    ERROR_REPORTING( E_ALL | E_STRICT );
  else: //if($_SERVER["SCRIPT_NAME"] != "/index.php"):
    error_logs('The site administrator has started the debug mode for maintenance<br>Access allowed only to developers, please contact an administrator to add your IP('.remoteIP().') to the system (if you are a developer of technical equipment).'); exit;
  endif;
endif;

require PATH_SYSTEM . 'config.php';

/*
function __autoload($autoload) {
    (@include PATH_CLASSES . $autoload . '.php' )or die(error_logs("The class $autoload does not exist"));
}
spl_autoload_register("__autoload"); //PHP 7.0*/

spl_autoload_register(function($autoload) {
  (@include PATH_CLASSES . $autoload . '.php' )or die(error_logs("The class $autoload does not exist"));
});

// require PATH_SYSTEM . 'websettings.php';

if(!defined('system_webscr')):
  $URLRequest=(isset($_SERVER['HTTP_REFERER'])) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : $_SERVER['HTTP_HOST'];
  $URLAuthorized=parse_url(site_url, PHP_URL_HOST);

  if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])):
    $current_url=$_SERVER['HTTP_X_FORWARDED_PROTO'];//https or http
  elseif(isset($_SERVER['REQUEST_SCHEME'])):
    $current_url=$_SERVER['REQUEST_SCHEME'];
  elseif(isset($_SERVER['HTTPS'])):
    $current_url=($_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
  endif;

  if(isset($_SERVER['HTTP_HOST'])):
    $current_url.='://' .$_SERVER['HTTP_HOST'];
  else:
    $current_url.='://' .$_SERVER['SERVER_NAME'];
  endif;


  if(system_sessions):
    session_set_cookie_params(0, '/', '.'.site_baseurl);
    session_name('logged');
    ini_set('session.cookie_domain', '.'.site_baseurl);
  endif;

  session_start();

endif;

if(isset($_GET) && count($_GET) > 0):
  foreach ($_GET as $key => $value):
    $_GET[$key]=escape($value);
  endforeach;
  $get = (new inputfilter)->process($_GET);
endif;

if(isset($_POST) && count($_POST) > 0):
  foreach ($_POST as $key => $value):
    $_POST[$key]=escape($value);
  endforeach;
  $post = (new inputfilter)->process($_POST);
elseif(file_get_contents("php://input")):
  $post=json_decode(file_get_contents("php://input"), TRUE);
  $post['response-type']='json';
endif;

if(system_apiMode):

  if(system_apiSecurity && !defined('system_webscr')):

    $authorizeds=array(
      domain($URLAuthorized)
      //,"programacion.grupofng.com"
    );

    if(!isset($post) || strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' || !in_array(domain($URLRequest), $authorizeds))
      error_logs("$URLRequest not authorized for this request");

  endif;

  header('Access-Control-Allow-Origin: '.site_url);
  header('Access-Control-Allow-Methods: GET, POST, REQUEST');
  header('Access-Control-Allow-Credentials: true');
else:
  require PATH_SYSTEM . 'core.php';
endif;

?>
