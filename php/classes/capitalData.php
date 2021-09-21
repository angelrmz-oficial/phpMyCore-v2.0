<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class capitalData //extends permissions
{
  //public $userData;
  public $data;

  function __construct($clave = null){
    $this->clave=$clave;
    $myssql=new myssql;
    $myssql->fetch("SELECT * FROM capitales WHERE clave='{$this->clave}' LIMIT 1");
    if($myssql->rows > 0)
      $this->data = $myssql->fetch;
  }
}
?>
