<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class router extends template
{
  public $router, $partial, $module;
  public $page = array();

  function __construct($router = '')
  {
    global $get;
    //routerURL, routerFile, routerName

    if($router !== ''):
      $this->router = $router;
      $this->partial = true;
    else:
      $this->router = empty($get['router']) ? 'index' : $get['router']; //index, domains
      $this->partial = false;
    endif;

    if(isset($get['module']) && !empty($get['module'])):
      $this->router=$get['module'] . DS . $this->router;
    endif;

    $this->get=$get;
    $this->page = $this->settings();

    //si es api
    (new sessions)->check($this->page['session']);

    if(!empty($this->page['permission']) && !(new userData)->hasPermissions($this->page['permission'])):
      redirect(sessions_home);
    endif;
    $this->GlobalParams();
  }

  function load(){

    ($this->partial === true) ? $this->views('iframe') : empty($this->page['view']) ? $this->pages($this->router) : $this->views($this->page['view']);

  }

  function settings(){
    $PageSettings=json_decode(file_get_contents(APP_TPL . 'router.json'), true);
    return isset($PageSettings[$this->router]) ? $PageSettings[$this->router] : $PageSettings['404'];
  }
}
?>
