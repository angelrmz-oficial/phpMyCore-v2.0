<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class WebApiRest
{

  public $error,$responseType;

  function __construct(){
    global $get, $post;

    $this->getResponseType($post['response-type']);

    $controllerName=$get['class'];
    $ControllerFile=REQUEST_DIR . "{$controllerName}.php";

    file_exists($ControllerFile) ? require $ControllerFile : $this->set_error('No se encontro el archivo del controlador');

    $controller = class_exists($controllerName, false) ? new $controllerName : $this->set_error('clase no existe');

    $function=$get['function'];
    is_callable(array($controller,$function)) ? $controller->$function() : $this->set_error('functions in class not callable');

  }

  function getResponseType($type){

    $error=false;
    if($type == "json"):
      $this->responseType="application/json";
    elseif($type == "html"):
      $this->responseType="text/html";
    elseif($type == "script"):
      $this->responseType="application/javascript";
    else:
      $this->responseType="application/json";
      // $error=true;
    endif;
    // header('Content-Type: '. $this->responseType);
    header('Content-Type: '.$this->responseType.'; charset='. system_charset);
    //header('Content-Type: '.$this->responseType.'; charset='. system_charset);

    // if($error):
    //   $this->set_error('no mames no hay content type');
    // endif;

  }

  function set_error($error){
    $this->error = $error;
    $this->response();
    exit;
  }

  function response(){
    if($this->responseType == "application/json"):
      $this->response_json($this->error, false);
    elseif($this->responseType == "text/html"):
      echo "<div class=\"alert alert-danger\">$this->error</div>";
    endif;
  }

  function response_json($message='',$success=true){
    $json['message']=$message;
    $json['success']=$success;
    echo json_encode($json);
    exit;
  }
  function response_html($widget, $params){
    $tpl=new template;
    if($params !== ''):
      foreach ($params as $key => $value):
        $tpl->SetParam($key, $value);
      endforeach;
    endif;
    $tpl->widgets($widget);
  }
}
?>
