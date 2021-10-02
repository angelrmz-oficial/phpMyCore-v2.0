<?php
class app // extends AnotherClass
{

  function __construct()
  {
    global $app;
    $this->app=$app;
  }

  function pmc($key, $value){
    $this->app['pmc'][$key]=$value;
    return (file_put_contents(PATH_EXTRADATA . 'app.pmc.json', json_encode($this->app['pmc'])) === FALSE) ? false : true;
  }



  function getParentNameById($id, $router = site_theme, $return = ""){
    foreach(json_decode(file_get_contents(PATH_TPL . $router . DS . 'router.json'), true) as $routerName => $cgs)
        if($cgs['id'] == $id)
          $return = $routerName;// $routerName;

    return $return;
  }

  function CheckRouteName($name, $return = true){
    $routerFile=APP_TPL . 'router.json';

    $routerJSON=json_decode(file_get_contents($routerFile), true);

    foreach ($routerJSON as $router => $cfg):
      if($router == $name):
        $return=false;
        break;
      endif;
    endforeach;

    return $return;

  }

  function addroute($data){

    $routerFile=APP_TPL . 'router.json';

    $routerJSON=json_decode(file_get_contents($routerFile), true);

    $routerJSON[$data['route']] = array (
      "id" => count($routerJSON) + 1,
      "subtitle" => trim($data['subtitle']),
      "submenu" => trim($data['submenu']),
      "subid" => empty(trim($data['subid'])) ? -1 : trim($data['subid']),
      "session" => $data['session'] == "on" ? true : false,
      "permission" => trim($data['permission']),
      "view" => trim($data['view'])
    );

    return (file_put_contents(APP_TPL . 'router.json', json_encode($routerJSON)) === FALSE) ? false : true;

  }

  function editroute($data){
    $routerFile=APP_TPL . 'router.json';
    $routerJSON=json_decode(file_get_contents($routerFile), true);
    if(isset($routerJSON[$data['route']])):
      $routerJSON[$data['route']]['subtitle'] = trim($data['subtitle']);
      $routerJSON[$data['route']]['submenu'] = trim($data['submenu']);
      $routerJSON[$data['route']]['subid'] = (empty(trim($data['subid'])) ? -1 : trim($data['subid']));
      $routerJSON[$data['route']]['session'] = $data['session'] == "on" ? true : false;
      $routerJSON[$data['route']]['permission'] = trim($data['permission']);
      $routerJSON[$data['route']]['view'] = trim($data['view']);
      return (file_put_contents(APP_TPL . 'router.json', json_encode($routerJSON)) === FALSE) ? false : true;
    else:
      return false;
    endif;
  }

  function deleteroute($routeName){
    $routerFile=APP_TPL . 'router.json';

    $routerJSON=json_decode(file_get_contents($routerFile), true);

    unset($routerJSON[$routeName]);

    return (file_put_contents(APP_TPL . 'router.json', json_encode($routerJSON)) === FALSE) ? false : true;

  }
  function extractpl($zipdir, $extdir){
    $zip = new ZipArchive();
    if ($zip->open($zipdir) === TRUE) { //$r=$zip->open($zipdir, ZipArchive::CREATE);
      $zip->extractTo($extdir); //, 'font_files/AlegreyaSans-Light.ttf' .. create folder unzip?
      $zip->close();
      return true;
    }else{
      return false;
    }
  }
  function create_defaultpl($tplname){

    $base=PATH_TPL . $tplname . DS;

    if(is_dir($base) === false)
      mkdir($base);

    foreach (array("assets", "modals", "pages", "statics", "views") as $folder)
      if( is_dir($base . $folder) === false )
        mkdir($base . $folder);

    file_put_contents($base . 'assets' . DS . 'app.web.js', file_get_contents($this->app['pmc']['repository'] . "/templates/default/assets/app.web.js"));
    //add views.. index, pages, iframe and 404?

    $router='{
      "404":
      {
        "id":0,
        "subtitle":"Error 404",
        "submenu":"",
        "subid":-1,
        "session":false,
        "permission":"",
        "view":"404"
      },
      "index":
      {
        "id":1,
        "subtitle":"Index",
        "submenu":"",
        "subid":-1,
        "session":false,
        "permission":"",
        "view":"index"
      },
      "dashboard":
      {
        "id":2,
        "subtitle":"Home",
        "submenu":"",
        "subid":-1,
        "session":true,
        "permission":"",
        "view":"pages"
      }
    }';

    file_put_contents($base . 'router.json', $router);

    return true;
  }

  function adduser($username,$password,$permissions,$ips){
    array_push($this->app['users'], array(
      "username" => $username,
      "hashpass" => $password,
      "last_ip" => null,
      "last_connection" => null,
      "permissions" => $permissions,
      "ips" => $ips
    ));
    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;
  }

  function edituser($username,$newusername,$password,$permissions,$ips){
    foreach ($this->app['users'] as $i => &$user):
      if($user['username'] == $username):
        $this->app['users'][$i]['username']=$newusername;
        $this->app['users'][$i]['hashpass']=($password !== "") ? $password : $this->app['users'][$i]['password'];
        $this->app['users'][$i]['permissions']=$permissions;
        $this->app['users'][$i]['ips']=$ips;
      endif;
    endforeach;

    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;
  }

  function deleteuser($username){
    foreach ($this->app['users'] as $i => &$user):
       if($user['username'] == $username):
         unset($this->app['users'][$i]);
       endif;
     endforeach;
    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;
  }

  function updateuser($username, $arrays){
    foreach ($this->app['users'] as $i => &$user):
      if($user['username'] == $username):
        foreach ($arrays as $key => $value) {
          $this->app['users'][$i][$key]=$value;
        }
      endif;
    endforeach;
    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;
  }

  function add_ip($_user){
    foreach ($this->app['users'] as $i => &$user):
      if($user == $_user):
         array_push($this->app['users'][$i]['ips'], remoteIP());
       endif;
     endforeach;
    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;
  }

  function last($_user){
    foreach ($this->app['users'] as $i => &$user):
      if($user == $_user):
        $this->app['users'][$i]['last_ip']=remoteIP();
        $this->app['users'][$i]['last_connection']=date("Y-m-d H:i:s");
      endif;
    endforeach;
    return (file_put_contents(PATH_EXTRADATA . 'app.users.json', json_encode($this->app['users'])) === FALSE) ? false : true;

  }

  function settings($data){
    foreach ($data as $key => $value):
      if(isset($this->app['settings'][$key])):
        $this->app['settings'][$key]=($value == "on" || $value == "off" || $value == "true" || $value == "false") ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : $value;
      endif;
    endforeach;
    return (file_put_contents(PATH_EXTRADATA . 'app.settings.json', json_encode($this->app['settings'])) === FALSE) ? false : true;
  }

}

?>
