<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class directorio extends WebApiRest
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
  function enlazar(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="directorio";
    $myssql->params['enlace']=1;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Directorio enlazado con éxito");
  }
  function descartar(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="directorio";
    $myssql->params['enlace']=2;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Directorio enlazado con éxito");
  }

  function laborado(){
    //$this->post['id']//actualizar enlace a 1.
    $myssql=new myssql;
    $myssql->table="directorio";
    $myssql->params['enlace']=3;
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Directorio enlazado con éxito");
  }

  function actualizar(){
    $myssql=new myssql;
    $myssql->table="directorio";
    $myssql->params['correo']=$this->post['correo'];
    $myssql->params['tel']=$this->post['tel'];
    $myssql->where['id']=$this->post['id'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Datos actualizados con éxito");
  }

}

?>
