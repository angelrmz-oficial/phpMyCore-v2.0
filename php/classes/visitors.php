<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');
class visitors
{
  public $date;
  function __construct(){
    $this->date=date("Y-m-d");
    $this->myssql=new myssql;
  }

  function init(){
    $this->myssql->fetch("SELECT * FROM visitors_data WHERE fecha='{$this->date}' LIMIT 1");
    if($this->myssql->rows == 0):
        $this->myssql->clean();
        $this->myssql->table="visitors_data";
        $this->myssql->params['fecha']=$this->date;
        $this->myssql->params['ip']=remoteIP();
        $this->myssql->FilterParams();
        $this->myssql->insert();
    elseif(!preg_match('/'.remoteIP().'/i', $this->myssql->fetch['ip'])):
        $this->myssql->clean();
        $this->myssql->table="visitors_data";
        $this->myssql->params['ip']="{$this->myssql->fetch['ip']} ". remoteIP();
        $this->myssql->params['views']="views+1";
        $this->myssql->where['fecha']=$this->date;
        $this->myssql->FilterParams();
        $this->myssql->update(true);
    endif;
  }

  function data(){
    for($i=1;$i <= 12; $i++){
      $visitors[$i]=0;
    }
    
    $json=[];

    $this->myssql->fetch("SELECT * FROM visitors_data WHERE YEAR(fecha) = YEAR(CURDATE()) ORDER BY DATE(fecha) ASC", true);
    if($this->myssql->rows > 0):
      foreach($this->myssql->fetch as $data)
        $m=intval(date('m', strtotime($data['fecha'])));
        $visitors[$m]=intval($data['views']);
    endif;
    
    foreach($visitors as $views)
      array_push($json, $views);

    echo json_encode($json);
  }
}

?>