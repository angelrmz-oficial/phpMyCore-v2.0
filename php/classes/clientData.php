<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class clientData //extends permissions
{
  //public $userData;
  public $data;

  function __construct($id = null){
    $this->id_cliente=$id;
    $myssql=new myssql;
    $myssql->fetch("SELECT * FROM cartera WHERE id='{$this->id_cliente}' LIMIT 1");
    if($myssql->rows > 0)
      $this->data = $myssql->fetch;
  }
}
?>
