<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class cartera extends WebApiRest
{
  //enlace 0=General, 1=enlazado, 2=descartado, 3=laborado.
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }
  function prospecto(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="cartera";
    $myssql->params['prospecto']=1;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Prospecto agregado con éxito");
  }
  function laborado(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="cartera";
    $myssql->params['prospecto']=2;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Cliente laborado con éxito");
  }
  function profuturo(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="cartera";
    $myssql->params['prospecto']=3;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Cliente ha sido movido a profuturo");
  }

  function nointeres(){
    $myssql=new myssql;
    $myssql->table="cartera";
    $myssql->params['prospecto']=4;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("El cliente ha sido movido a no interés");
  }
//no interes
  function actualizar(){
    $myssql=new myssql;
    $myssql->table="cartera";
    foreach ($this->post as $key => $value):
      if($key != "response-type" && $key != "id") //!empty($value) &&
        $myssql->params[$key]=$value;
    endforeach;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Cliente actualizado con éxito");
  }

  function agendar(){
    $myssql=new myssql;
    $myssql->table="recordatorios";
    if(isset($this->post['id_cliente']) && !empty($this->post['id_cliente']) && $this->post['id_cliente'] > 0):
      $myssql->params['id_cliente']=$this->post['id_cliente'];
    endif;
    $myssql->params['asunto']=$this->post['asunto'];
    $myssql->params['fecha']=date("d/m/Y g:i a");
    $myssql->params['fecha_inicio']=$this->post['fecha_inicio'];
    $myssql->params['fecha_fin']=$this->post['fecha_fin'];
    $myssql->params['nota']=$this->post['nota'];
    $myssql->FilterParams();
    $myssql->insert();
    $this->response_json("Recordatorio agregado con éxito!");
  }
}

?>
