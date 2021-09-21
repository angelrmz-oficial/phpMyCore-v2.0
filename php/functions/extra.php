<?php
if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');


function array_check($key, $array){
  return in_array($key, $array) ? true : false;
}

function issempty($var){
  return (isset($var) && !empty($var)) ? true : false;
}

function directory($def, $value){
  define($def, $value . DS);
}

function include_php($dir){
  require "$dir.php";//
}

function streplace($param, $val){
  return str_replace("{".$param."}", constant("$param"), $val);
}

/*

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PATH_PHP));

foreach ($rii as $file):
  if ($file->isDir())
    continue;

  if(basename($_SERVER['PHP_SELF']) == basename($file->getPathname()))
   error_logs('save error'); exit;

endforeach;

*/


?>
