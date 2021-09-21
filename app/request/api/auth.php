<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');
class auth extends WebApiRest
{
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }

  function login(){
    $myssql=new myssql;
    $myssql->fetch("SELECT * FROM users_data WHERE username='{$this->post['username']}' LIMIT 1");
    if($myssql->rows < 1):
      $this->response_json("{$this->post['username']} no está asociado con ninguna cuenta.", false);
    elseif($myssql->fetch['password'] != encrypt($this->post['password'])):
      $this->response_json("La contraseña que ingresaste es incorrecta", false);
    elseif(!(new sessions)->create($myssql->fetch['id'])):
      $this->response_json("No fue posible crear una sesión, intentalo de nuevo más tarde.", false);
    else:
      $id=$myssql->fetch['id'];
      $myssql->clean();
      $myssql->table="users_data";
      $myssql->params['last_login']=date('d/m/Y g:i a');
      $myssql->where['id']=$id;
      $myssql->FilterParams();
      $myssql->update();
      $this->response_json("", true);
    endif;
  }
}
?>
