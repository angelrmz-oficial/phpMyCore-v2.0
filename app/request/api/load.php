<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class load extends WebApiRest
{
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }

  function page(){
    //comprobar session
    return (new router($this->post['page']))->load();
  }

  function modal(){
    return (new template)->modals($this->post['modal']);
  }

  function client(){
    //un hash?
    return (new template)->scripts('client');
  }

  function userson(){

  }
  /*
  function reload(){

    $success=((new shoutcast)->ServerStatus()) ? (new shoutcast)->server_stop() : (new shoutcast)->server_start();
    $this->response_json('Si este mensaje aparece, contactar a soporte', $success);

  }

  function autodj(){
    $success=((new shoutcast)->StreamStatus()) ? (new shoutcast)->autodj_stop() : (new shoutcast)->autodj_start();
    $this->response_json('Si este mensaje aparece, contactar a soporte', $success);
  }*/
}



/*

//comprobar puerto manualmente
$content = @file_get_contents('http://35.243.250.23:32000/stats?sid=1');
if($content === false):
  $stream_status=false;
else:
  $stream_status=true;
  //$nice_url = urlencode ($url);
  $sc_stats = simplexml_load_file ($content);
  echo $sc_stats->CURRENTLISTENERS;
endif;

//$shoutcast=new Shoutcast('35.243.250.23', 32000, 'AdminPass1026');

//$stream_status=(!empty($shoutcast->_error)) ? true : false;
//$stream_stats=$shoutcast->getBasicStats();

$tpl=new template;

$tpl->SetParam('text_color', ($stream_status) ? 'text-green' : 'text-red');
$tpl->SetParam('stream_status', ($stream_status) ? 'En línea' : 'Desconectado');//fuera de línea, detenido, apagado
//$posted['']
$tpl->widgets($post['widget']);

/*
$ url = "http://sudominio.com:8000/stats?sid=1";

$ nice_url = urlencode ($ url);

$ sc_stats = simplexml_load_file ($ nice_url);

echo $ sc_stats-> CURRENTLISTENERS; */



//widget-name
/*widget, shell, json

response-data; radio-status
response-type: html          //html, json


//self::response_$this->responseType



$API=new WebApiRest;
$API->responseType=$post['response-type'];

switch ($post['response-type']) {
  case 'json':

    break;
  case 'html':

  default:
    // code...
    break;
}
//$API->response("Lo sentimos, no fue posible realizar esta acción");*/
?>
