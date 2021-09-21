<?php
if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

function generarFolio($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}


function generateTicket()
{
  $key = 'ST-';
  $keys = array_merge(range(0, 9), range('a', 'z'));

  for ($i=1; $i<=6; $i++)
  {
    $key .= $keys[array_rand($keys)];
  }

  $key = $key . "-galaxy-";

  for ($i=1; $i<=20; $i++)
  {
    $key = $key . rand(0,9);
  }

  return $key;
}

function generateToken(){
  $token = generateTicket();
  $hash ="xCg532%@%gdvf^5DGaa6&*rFTfg^FD4\(ugf*/";
  $token .= time();
  return md5($token . $hash);
}
function generarCodigo($longitud, $numeric=false)
{
    //creamos la variable codigo
    $codigo = "";
    //caracteres a ser utilizados

    $caracteres= ($numeric) ? "0123456789" : "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    //el maximo de caracteres a usar
    $max=strlen($caracteres)-1;
    //creamos un for para generar el codigo aleatorio utilizando parametros min y max
    for($i=0;$i < $longitud;$i++)
    {
        $codigo.=$caracteres[rand(0,$max)];
    }
    //regresamos codigo como valor
    return $codigo;
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>
