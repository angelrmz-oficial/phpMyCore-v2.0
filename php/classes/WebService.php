<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class WebService
{
  public $request, $logDate;

  function __construct($log = false){
    global $get;
    $this->logDate=date("d-m-Y-H-i");

    $controllerName=$get['class'];
    $ControllerFile=REQUEST_DIR . "{$controllerName}.php";

    file_exists($ControllerFile) ? require $ControllerFile : $this->set_error('No se encontro el archivo del controlador');

    $controller = class_exists($controllerName, false) ? new $controllerName : $this->set_error('clase no existe');

    $function=$get['function'];
    is_callable(array($controller,$function)) ? $controller->$function() : $this->set_error('functions in class not callable');

  }
  function set_error($log){
    file_put_contents(PATH_LOGS . 'ws_error_'.date('d-M-Y').'.log', $log . "\n", FILE_APPEND);
    error_log($log, 1, "contacto.angelrmz@gmail.com","Subject: Foo\nFrom: no-reply@jolum.es\n");
  }
}

?>
