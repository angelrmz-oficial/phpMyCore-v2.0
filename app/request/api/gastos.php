<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class gastos extends WebApiRest
{
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }
  function agregar(){
    $myssql=new myssql;
    $myssql->table="gastos";
    $myssql->params['concepto']=$this->post['concepto'];
    $myssql->params['cantidad']=$this->post['cantidad'];
    $myssql->params['fecha_vence']=$this->post['fecha_vence'];
    $myssql->params['fecha_limite']=$this->post['fecha_limite'];
    $myssql->params['recurrente']=$this->post['recurrente'];
    $myssql->params['fecha_alta']=date("d/m/Y H:i");
    $myssql->FilterParams();
    $myssql->insert();
    $this->response_json("Gasto agregado con éxito!");
  }
}
?>
