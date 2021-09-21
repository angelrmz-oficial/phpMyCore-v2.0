<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class consulta extends WebApiRest
{
  public $post;//?
  function __construct()
  {
    global $post, $_SESSION;
    $this->post=$post;
    $this->getResponseType($post['response-type']);
    //(new userData)->get_AccountId();
  }

  function directorioGeneral(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT id,empresa,tamano,ley_73,ley_97,total_trab,delegacion,tel,correo FROM directorio WHERE enlace=0", true);
    foreach ($myssql->fetch as $directorio):
      $btn='<div class="btn-group"><button type="button" class="btn btn-sm success postRequest" data-api="directorio/enlazar" data-handler="directorioEnlazar" data-post=\'{"id":"'.$directorio['id'].'"}\'>Enlazar</button>';
      $btn.='<button type="button" class="btn btn-sm warning postRequest" data-api="directorio/descartar" data-handler="directorioDescartado" data-post=\'{"id":"'.$directorio['id'].'"}\'>Descartar</button>';
      $btn.='<button type="button" class="btn btn-sm primary openModal" data-modal="directorio_actualizar" data-post=\'{"id":"'.$directorio['id'].'"}\'>Actualizar</button></div>';
      array_push($responseJson, array($directorio['empresa'],$directorio['tamano'],$directorio['ley_73'],$directorio['ley_97'],$directorio['total_trab'],$directorio['delegacion'],$directorio['tel'],$directorio['correo'],$btn));
    endforeach;
    echo safe_json_encode($responseJson);
  }

  function directorioEnlazado(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT id,empresa,tamano,ley_73,ley_97,total_trab,delegacion,tel,correo FROM directorio WHERE enlace=1", true);
    foreach ($myssql->fetch as $directorio):
      $btn='<div class="btn-group"><button type="button" class="btn btn-sm danger postRequest" data-api="directorio/laborado" data-handler="directorioLaborado" data-post=\'{"id":"'.$directorio['id'].'"}\'>Laborado</button>';
      $btn.='<button type="button" class="btn btn-sm primary openModal" data-modal="directorio_actualizar" data-post=\'{"id":"'. $directorio['id'] .'"}\'>Actualizar</button></div>';
      array_push($responseJson, array($directorio['empresa'],$directorio['tamano'],$directorio['ley_73'],$directorio['ley_97'],$directorio['total_trab'],$directorio['delegacion'],$directorio['tel'],$directorio['correo'],$btn));
    endforeach;
    echo safe_json_encode($responseJson);
  }
  function directorioDescartado(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT empresa,tamano,ley_73,ley_97,total_trab,delegacion,tel,correo FROM directorio WHERE enlace=2", true);
    foreach ($myssql->fetch as $directorio):
      $btn="";//"<button>Actualizar</button>";
      array_push($responseJson, array($directorio['empresa'],$directorio['tamano'],$directorio['ley_73'],$directorio['ley_97'],$directorio['total_trab'],$directorio['delegacion'],$directorio['tel'],$directorio['correo'],$btn));
    endforeach;
    echo safe_json_encode($responseJson);
  }

  function carteraProspectos(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT id, nombre,paterno,materno, empresa, calle, colonia, municipio_2, cp_2, correo, telefonos FROM cartera WHERE prospecto=1", true);//limit?
    if($myssql->rows > 0): //exit("nou {$myssql->rows}");
      foreach ($myssql->fetch as $client):
        $btns='<div><div class="item-action dropdown"><a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right text-color" role="menu">';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/laborado" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-archive"></i> Archivar</a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_agendar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-calendar"></i> Recordatorio </a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_actualizar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-pencil"></i> Actualizar datos </a>';
        $btns.='<div class="dropdown-divider"></div>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_detalles" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-ellipsis-h"></i> Ver detalles</a>';
        $btns.='</div></div></div>';

        array_push($responseJson,
          array(
            "{$client['nombre']} {$client['paterno']} {$client['materno']}",
            $client['empresa'],
            "{$client['calle']}, {$client['colonia']}, {$client['municipio_2']} {$client['cp_2']}",
            $client['correo'],
            $client['telefonos'],
            $btns
          )
        );


      endforeach;




    endif;

    echo safe_json_encode($responseJson);
  }

  function carteraProfuturo(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT id, nombre,paterno,materno, empresa, calle, colonia, municipio_2, cp_2, correo, telefonos FROM cartera WHERE prospecto=3", true);//limit?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $client):
        $btns='<div><div class="item-action dropdown"><a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right text-color" role="menu">';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/laborado" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-archive"></i> Archivar</a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_agendar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-calendar"></i> Recordatorio </a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_actualizar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-pencil"></i> Actualizar datos </a>';
        $btns.='<div class="dropdown-divider"></div>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_detalles" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-ellipsis-h"></i> Ver detalles</a>';
        $btns.='</div></div></div>';
        array_push($responseJson,
          array(
            "{$client['nombre']} {$client['paterno']} {$client['materno']}",
            $client['empresa'],
            "{$client['calle']}, {$client['colonia']}, {$client['municipio_2']} {$client['cp_2']}",
            $client['correo'],
            $client['telefonos'],
            $btns
          )
        );
      endforeach;
    endif;
    echo safe_json_encode($responseJson);
  }

  function carteraNointeres(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT id, nombre,paterno,materno, empresa, calle, colonia, municipio_2, cp_2, correo, telefonos FROM cartera WHERE prospecto=4", true);//limit?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $client):
        $btns='<div><div class="item-action dropdown"><a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right text-color" role="menu">';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/laborado" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-archive"></i> Archivar</a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_agendar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-calendar"></i> Recordatorio </a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_actualizar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-pencil"></i> Actualizar datos </a>';
        $btns.='<div class="dropdown-divider"></div>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_detalles" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-ellipsis-h"></i> Ver detalles</a>';
        $btns.='</div></div></div>';
        array_push($responseJson,
          array(
            "{$client['nombre']} {$client['paterno']} {$client['materno']}",
            $client['empresa'],
            "{$client['calle']}, {$client['colonia']}, {$client['municipio_2']} {$client['cp_2']}",
            $client['correo'],
            $client['telefonos'],
            $btns
          )
        );
      endforeach;
    endif;
    echo safe_json_encode($responseJson);
  }

  function simple(){
    $responseJson=array();
    $search_term=$this->post['term'];
    $myssql=new myssql;// LIMIT {$this->post['pag']}, 100
    $myssql->fetch("SELECT * FROM cartera WHERE (curp='{$search_term}' OR nss='{$search_term}' OR CONCAT_WS(' ', nombre, paterno, materno) LIKE UPPER('%{$search_term}%'))", true);//limit? AND in?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $client):
        $btns='<div><div class="item-action dropdown"><a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right text-color" role="menu">';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/prospecto" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-check"></i> Prospecto</a>';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/profuturo" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-times"></i> Profuturo</a>';

        $btns.='<a class="dropdown-item postRequest" data-api="cartera/nointeres" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-asterisk"></i> No interés</a>';

        $btns.='<a class="dropdown-item openModal" data-modal="cartera_agendar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-calendar"></i> Recordatorio </a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_actualizar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-pencil"></i> Actualizar datos </a>';
        $btns.='<div class="dropdown-divider"></div>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_detalles" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-ellipsis-h"></i> Ver detalles</a>';
        $btns.='</div></div></div>';
        array_push($responseJson, array(
          "{$client['nombre']} {$client['paterno']} {$client['materno']}",
          $client['empresa'],
          "{$client['calle']}, {$client['colonia']}, {$client['municipio_2']} {$client['cp_2']}",
          $client['correo'],
          $client['telefonos'],
          $btns
        ));
      endforeach;
    endif;
    echo safe_json_encode($responseJson);
  }
  function empresas(){

    $responseJson=array();
    $myssql=new myssql;
    $sql="SELECT empresa FROM cartera WHERE ". "(estado LIKE UPPER('%{$this->post['estado']}%') AND prospecto=0) GROUP BY empresa";
    $myssql->fetch($sql, true);//limit? AND in?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $r):
        $responseJson[] = array(
            "id" => $r['empresa'],
            "text" => $r['empresa']
         );
       endforeach;
     endif;
     echo safe_json_encode($responseJson);
  }

  function completa(){
    $responseJson=array();
    $myssql=new myssql;// LIMIT {$this->post['pag']}, 100
    $sql="SELECT * FROM cartera WHERE ";
    $sql.= (!empty($this->post['empresa'])) ?
    "(estado LIKE UPPER('%{$this->post['estado']}%') AND empresa LIKE UPPER('%{$this->post['empresa']}%'))  AND prospecto=0" :
    "(estado LIKE UPPER('%{$this->post['estado']}%') AND prospecto=0)";

    if(isset($this->post['ley'])):
      $ley=$this->post['ley'];
      $sql.=" AND ley='{$ley}'";
    endif;

    if($this->post['biometricos'] == "on"):
      $sql.=" AND biometrico = '1'";
    endif;

    if(!empty($this->post['puntos']) && is_numeric($this->post['puntos']) && $this->post['puntos'] > 0):
      $sql.="AND pts >= ". $this->post['puntos'];
    endif;

    if(!empty($this->post['rcv']) && is_numeric($this->post['rcv']) && $this->post['rcv'] > 0):
      $sql.="AND saldo >= ". $this->post['rcv'];
    endif;

    if(!empty($this->post['cot']) && is_numeric($this->post['cot']) && $this->post['cot'] > 0):
      $cot=($this->post['cot'] > 1000) ? substr($this->post['cot'], -2) : $this->post['cot'];
      $sql.=" AND substring(nss,3,2) = '{$cot}'";
    endif;

    if(!empty($this->post['nombre'])):
      $nombre=$this->post['nombre'];
      $sql.=" AND CONCAT_WS(' ', nombre, paterno, materno) LIKE UPPER('%{$nombre}%')";
    endif;

    $myssql->fetch($sql, true);//limit? AND in?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $client):
        $btns='<div><div class="item-action dropdown"><a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right text-color" role="menu">';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/prospecto" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-check"></i> Prospecto</a>';
        $btns.='<a class="dropdown-item postRequest" data-api="cartera/profuturo" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-times"></i> Profuturo</a>';

        $btns.='<a class="dropdown-item postRequest" data-api="cartera/nointeres" data-handler="cartera" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-asterisk"></i> No interés</a>';

        $btns.='<a class="dropdown-item openModal" data-modal="cartera_agendar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-calendar"></i> Recordatorio </a>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_actualizar" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-pencil"></i> Actualizar datos </a>';
        $btns.='<div class="dropdown-divider"></div>';
        $btns.='<a class="dropdown-item openModal" data-modal="cartera_detalles" data-post=\'{"id":"'.$client['id'].'"}\'><i class="fa fa-ellipsis-h"></i> Ver detalles</a>';
        $btns.='</div></div></div>';
        array_push($responseJson, array(
          "{$client['nombre']} {$client['paterno']} {$client['materno']}",
          $client['empresa'],
          $client['pts'],
          $client['saldo'],
          $client['correo'],
          $client['telefonos'],
          $btns
        ));
      endforeach;
    endif;
    echo safe_json_encode($responseJson);
  }

  function calendario(){
    $responseJson=array();
    $myssql=new myssql;// LIMIT {$this->post['pag']}, 100
    $myssql->fetch("SELECT * FROM recordatorios", true);//limit? AND in?
    if($myssql->rows > 0):
      foreach ($myssql->fetch as $cita):
        $nombre="";
        if(!empty($r['id_cliente']) && $r['id_cliente'] > 0):
          $client=(new clientData($r['id_cliente']))->data;
          $nombre="{$client['nombre']} {$client['paterno']} {$client['materno']}";
        endif;
        array_push($responseJson, array(
          "id" => $cita['id'],
          "title" => $cita['asunto'],
          "description" => $cita['nota'],
          "className" => ["white"],
          "status" => ($cita['status'] == 0) ? "success" : "danger",
          "participant" => array($nombre),
          "start" => $cita['fecha_inicio'],
          "end" => $cita['fecha_fin']
        ));
      endforeach;
    endif;
    echo safe_json_encode($responseJson);
  }

  function recordatorios(){
    $responseJson=array();
    $myssql=new myssql;
    $myssql->fetch("SELECT * FROM recordatorios", true);
    foreach ($myssql->fetch as $r):
      $btn="";//"<button>Actualizar</button>";
      $nombre="";
      if(!empty($r['id_cliente']) && $r['id_cliente'] > 0):
        $client=(new clientData($r['id_cliente']))->data;
        $nombre="{$client['nombre']} {$client['paterno']} {$client['materno']}";
      endif;
      array_push($responseJson, array(
        $r['asunto'],
        $r['nota'],
        $nombre,
        $r['fecha'],
        date("d/m/Y g:i a", strtotime($r['fecha_inicio'])),
        date("d/m/Y g:i a", strtotime($r['fecha_fin'])),
        ($r['status'] == 0) ? '<span class="badge green text-sm">Activo</span>' : '<span class="badge dark text-sm">Completado</span>',
        $btn
      )
    );
    endforeach;
    echo safe_json_encode($responseJson);
  }

}
?>
