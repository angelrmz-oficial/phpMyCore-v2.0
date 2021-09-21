<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');
/*
class webcfg
{
    public $cfg;
    function __construct(){

      $myssql=new myssql;
      $myssql->fetch("SELECT * FROM galaxycms_settings");
      if($myssql->rows > 0)
        foreach ($myssql->fetch as $cfgs)
            $this->cfg[$cfgs['cfg']] = $cfgs['value'];
    }
    /*function update_cfg($key, $value){}*
    function cfg($key)
    {
        return ($this->cfg[$key] == "true" || $this->cfg[$key] == "false") ?
        filter_var($this->cfg[$key], FILTER_VALIDATE_BOOLEAN) : $this->cfg[$key];
    }

    function update_cfg($key, $value){
      $myssql=new myssql;
      $myssql->table="galaxycms_settings";
      $myssql->params['value']=($value == "on" || $value == "off") ? is_true($value) : $value;
      $myssql->where['cfg']=$key;
      $myssql->FilterParams();
      $myssql->update();
    }
}*/
?>
