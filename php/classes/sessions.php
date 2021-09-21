<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class sessions
{

  public $data;

  function __construct($func = ''){
    global $_SESSION, $_SERVER;
    $this->myssql = new myssql;
  }

  function response($message){
    if(system_apiMode): //si es html
      echo "<div id='contentPage' class='resize' ><habbo-empty-results>$message <br><center><button onclick='location.reload()' class='btn medium green'>Ok</button></center></habbo-empty-results></div>";
        exit;
    else:
      redirect('logout');
    endif;
  }

  function create($id_us){

    $this->myssql->fetch("SELECT * FROM sessions_data WHERE account_id='{$id_us}' LIMIT 1");

    if($this->myssql->rows > 0):
      self::delete($this->myssql->fetch['sessionId']); //delete logs
    endif;

    $this->myssql->clean();

    $token=generateToken();

    $this->myssql->table="sessions_data";
    $this->myssql->params['session_hash']=$token;
    $this->myssql->params['account_id']=$id_us;
    $this->myssql->params['ip']=remoteIP();
    $this->myssql->params['timestart']=time();
    $this->myssql->params['timexpire']=time() + 10800;
    $this->myssql->FilterParams();
    $this->myssql->insert();

    $_SESSION['sessionId']=(int)$this->myssql->insertId;
    $_SESSION['userid']=$id_us;

    $this->myssql->clean();

    /*$_SESSION['sessionId']=$sessionId['sessionId'];
    $this->mysqli->query("UPDATE usuarios SET status = 1 WHERE id = '{$id_us}' LIMIT 1");
    $session['nivel']  = utf8_encode($r['perfil']);
    $session['status'] = 1; echo $id_us; access_logs*/

    return (isset($_SESSION['sessionId']) && !empty($_SESSION['sessionId'])) ? true : false;
  }

  function check($require_session){

    $index=str_replace(str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']), '', PATH_ROOT) . 'index.php';
    $scripts = array('/','/index');//str_replace('\\', '/', $index),
    //$scripts = array('/proyects/developed/index.php','/registro.php','/recuperar.php');

    if(!$require_session && isset($_SESSION['sessionId']) && in_array($_SERVER['REQUEST_URI'], $scripts)):
      redirect(sessions_home);
    endif;

    if($require_session && !isset($_SESSION['sessionId'])):
      redirect('index');
    endif;

    if(isset($_SESSION['sessionId'])):

      $this->myssql->fetch("SELECT * FROM sessions_data WHERE sessionId='{$_SESSION['sessionId']}'");

      if($this->myssql->rows > 0):
        if(time() > $this->myssql->fetch['timexpire']):
          self::delete();//Enviar un email donde se menciona que alguien ha ingresado recientemente... CON IP Y HORA DE CONEXIÓN
          self::response("La sesión ha expirado. Por favor vuelve a iniciar sesión");
        else:

          $timexpire=$this->myssql->fetch['timexpire'];
          $this->myssql->clean();

          $this->myssql->table="sessions_data";
          $this->myssql->params['timexpire']=$timexpire + 60;
          $this->myssql->where['sessionId']=$_SESSION['sessionId'];
          $this->myssql->FilterParams();
          $this->myssql->update();
          //$this->mysqli->query("UPDATE sessions_data SET timexpire=timexpire+60 WHERE sessionId='{$_SESSION['sessionId']}'");
        endif;
      else:
        self::delete();
        self::response("Hemos detectado otro inicio de sesión con esta misma cuenta.");
        //Enviar un email donde se menciona que alguien ha ingresado recientemente... CON IP Y HORA DE CONEXIÓN
      endif;

    endif;
  }

  function get_data(){
    //session hash
  }

  function delete($sessionId = ''){

    if(empty($sessionId) && isset($_SESSION['sessionId'])):
      $this->myssql->execute("DELETE FROM sessions_data WHERE sessionId='{$_SESSION['sessionId']}'");
      unset($_SESSION['sessionId']);
      session_destroy();
    else:
      $this->myssql->execute("DELETE FROM sessions_data WHERE sessionId='{$sessionId}'");
    endif;
  }

}
 ?>
