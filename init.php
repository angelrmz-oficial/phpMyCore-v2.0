<?php

if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

define('system_hashpass', 'hae2UnBRuXr7Ao0t8ypdshWNRV2JBWfBSi'); //Sst1232145jp

define('sessions_index', 'login');
define('sessions_home', 'dashboard'); //edit in app??

define('system_path', ''); // D:\Hosteos   /home/galaxycm/system

define('DS', DIRECTORY_SEPARATOR);
define('PATH', __DIR__ . DS); //dirname(__FILE__)
define('PATH_ROOT', (!defined('system_path') || empty(system_path)) ? PATH : system_path);
define('PATH_PHP', PATH_ROOT . 'php' . DS);
define('PATH_FUNCTIONS', PATH_PHP . 'functions' . DS);
define('PATH_SYSTEM', PATH_PHP . 'system' . DS);
define('PATH_EXTRADATA', PATH_SYSTEM . 'extradata' . DS);
define('PATH_CLASSES', PATH_PHP . 'classes' . DS);
define('PATH_POSTBACK', PATH_PHP . 'postback' . DS);
// define('PATH_LOGS', PATH_PHP . 'logs' . DS);
//defined("system_app") or die("no defined");

if(!defined('system_apiMode')):
  define('system_apiMode', false);
endif;

$app['users']=json_decode(file_get_contents(PATH_EXTRADATA . 'app.users.json'), true);
$app['settings']=json_decode(file_get_contents(PATH_EXTRADATA . 'app.settings.json'), true);
$app['logs']=json_decode(file_get_contents(PATH_EXTRADATA . 'app.logs.json'), true);
$app['pmc']=json_decode(file_get_contents(PATH_EXTRADATA . 'app.pmc.json'), true);

foreach ($app['settings'] as $key => $value)
  define($key, $value);

$devips=array();
foreach ($app['users'] as $user)
  foreach ($user['ips'] as $i => $ip)
    array_push($devips, $ip);

define('PATH_APP', PATH . 'app' . DS);
define('PATH_TPL', PATH . 'templates' . DS);
// define('PATH_ASSETS', PATH_APP . 'assets' . DS);
define('APP_TPL', PATH_TPL . site_theme . DS);
define('system_devIPs', $devips);//sacarlas de logs

$_functions[]='global';
$_functions[]='parseURL';
$_functions[]='random';
//$_functions[]='whois';
$_functions[]='filesManager';

foreach ($_functions as $function)
  (@include (PATH_FUNCTIONS ."{$function}.php"))or die("Can not find file '{$function}' in system functions");

(@include (PATH_PHP . 'autoload.php'))or die(error_logs('autoload no file'));

?>
