<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class cliente extends WebApiRest
{
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }
  function nuevo(){
    // try{
    $myssql=new myssql;
    $myssql->fetch("SELECT * FROM clientes WHERE nombre='{$this->post['nombre']}' AND apellidos='{$this->post['apellidos']}' LIMIT 1");
    if($myssql->rows < 1):
      $myssql->table="clientes";
      $myssql->params['nombre']=$this->post['nombre'];
      $myssql->params['apellidos']=$this->post['apellidos'];
      $myssql->params['direccion']=$this->post['direccion'];
      $myssql->params['localidad']=$this->post['localidad'];
      $myssql->params['zip']=$this->post['zip'];
      $myssql->params['correo']=$this->post['correo'];
      $myssql->params['telefono_fijo']=$this->post['telefono'];
      $myssql->params['telefono_movil']=$this->post['celular'];
      $myssql->params['fecha_alta']=date("d/m/Y H:i");
      $myssql->FilterParams();
      $myssql->insert();
      $this->response_json("¡Cliente registrado con éxito!");
    else:
      $this->response_json("Ya éxiste un cliente registrado con este nombre", false);
    endif;
    // }catch(Exception $err){
      // $this->response_json("Opps", false);
    // }
  }

  function baja(){
    //comprobar que no tenga prestamos activos
    $myssql=new myssql;
    $myssql->table="clientes";
    $myssql->params['estado']=0;
    $myssql->where['id_cliente']=$this->post['id_cliente'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("El cliente ha sido de BAJA", true);
  }

  function alta(){
    //comprobar que no tenga prestamos activos
    $myssql=new myssql;
    $myssql->table="clientes";
    $myssql->params['estado']=1;
    $myssql->where['id_cliente']=$this->post['id_cliente'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("El cliente ha sido de ALTA", true);
  }

  function editar(){
    $cliente=(new clientData($this->post['id']))->data;
    $myssql=new myssql;
    $myssql->table="clientes";
    if($cliente['nombre'] !== $this->post['nombre'])
      $myssql->params['nombre']=$this->post['nombre'];
    if($cliente['apellidos'] !== $this->post['apellidos'])
      $myssql->params['apellidos']=$this->post['apellidos'];
    if($cliente['direccion'] !== $this->post['direccion'])
      $myssql->params['direccion']=$this->post['direccion'];
    if($cliente['localidad'] !== $this->post['localidad'])
      $myssql->params['localidad']=$this->post['localidad'];
    if($cliente['zip'] !== $this->post['zip'])
      $myssql->params['zip']=$this->post['zip'];
    if($cliente['correo'] !== $this->post['correo'])
      $myssql->params['correo']=$this->post['correo'];
    if($cliente['telefono'] !== $this->post['telefono'])
      $myssql->params['telefono_fijo']=$this->post['telefono'];
    if($cliente['celular'] !== $this->post['celular'])
      $myssql->params['telefono_movil']=$this->post['celular'];
    $myssql->params['credito']=$this->post['credito'];
    $myssql->where['id_cliente']=$this->post['id_cliente'];
    $myssql->FilterParams();
    $myssql->update();
    $this->response_json("Información del cliente actualizada", true);
  }
}
?>
