<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');
class userData

{
  public $data;
  function __construct($id = null){
    global $_SESSION;
    $this->userid=is_null($id) ? $_SESSION['userid'] : $id;
    $myssql=new myssql;

    //fb_id, authy_id,vip,

    $myssql->fetch("SELECT * FROM users_data WHERE id='{$this->userid}' LIMIT 1");

    if($myssql->rows > 0)
      $this->data = $myssql->fetch;

    $this->data['session_hash'] = self::getSessionHash();
  }


  function getSessionHash(){

    $myssql=new myssql;

    $myssql->fetch("SELECT session_hash FROM sessions_data WHERE account_id='{$this->userid}' LIMIT 1");

    return ($myssql->rows > 0) ? $myssql->fetch['session_hash'] : null;

  }


  function getPermissions(){

    return explode(",",$this->data['permissions']);//hk_login

  }

  function hasPermissions($permission){

    return in_array($permission, $this->getPermissions()) ? true : false;

  }


  function UpdateGetSSO(){

    $sso = generateTicket();

    $myssql=new myssql;

    $myssql->table="user_tickets";

    $myssql->params['userid']=$_SESSION['userid'];

    $myssql->params['sessionticket']=$sso;

    //$myssql->FilterParams();

    $myssql->replace();

    return $sso;

  }

}

?>
