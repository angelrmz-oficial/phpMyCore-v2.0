<?php
if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

function safe_json_encode($value){
if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
    $encoded = json_encode($value, JSON_PRETTY_PRINT);
} else {
    $encoded = json_encode($value);
}
switch (json_last_error()) {
    case JSON_ERROR_NONE:
        return $encoded;
    case JSON_ERROR_DEPTH:
        return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_STATE_MISMATCH:
        return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_CTRL_CHAR:
        return 'Unexpected control character found';
    case JSON_ERROR_SYNTAX:
        return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_UTF8:
        $clean = utf8ize($value);
        return safe_json_encode($clean);
    default:
        return 'Unknown error'; // or trigger_error() or throw new
Exception();
}
}


function utf8ize($mixed) {
if (is_array($mixed)) {
    foreach ($mixed as $key => $value) {
        $mixed[$key] = utf8ize($value);
    }
} else if (is_string ($mixed)) {
    return utf8_encode($mixed);
}
return $mixed;
}

function redirect($self){
  //if() NO REDIRECCIONAR SI LO VA A TRAER AL DIRECTORIO ACTIAL
  exit( header("Location: http://{$_SERVER['HTTP_HOST']}/{$self}") );
}
function echopost($key){
  echo isset($_POST[$key]) ? $_POST[$key] : "";
}

function inputValid($value, $type)
{
  if (!empty($value)):
    switch ( $type ):
    	case 'email':
    	$p = '^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,48}$/';
    	break;

    	case 'username':
    	$p = '^[a-zA-Z0-9-]+_?[a-zA-Z0-9-]+$/D';
    	break;

    	case 'ip':
    	$p = '^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
    	break;

    	case 'credit_card':
    	$p = '^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/';
    	break;

    	case 'url':
    	$p = '^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
    	break;

    	case 'password':
    	$p = '^[a-z+0-9]/i';
    	break;

    	case 'subdomain':
    	$p = '^[a-z]{3,10}$/i';
    	break;

    	case 'domain':
    	$p = '^([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
    	break;

    	default:

    	  return false;
    	break;
    endswitch;

    $valid = preg_match("/$p", $value);

  	return (!$valid) ? false : true ;
  else:
    return false;
  endif;
}
function remoteIP()
{
  if(array_key_exists('HTTP_CLIENT_IP', $_SERVER))
    $real_ip = str_replace('::1', '127.0.0.1', $_SERVER['HTTP_CLIENT_IP']);
  elseif(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
    $real_ip = str_replace('::1', '127.0.0.1', $_SERVER['HTTP_X_FORWARDED_FOR']);
  elseif(array_key_exists('REMOTE_ADDR', $_SERVER))
    $real_ip = str_replace('::1', '127.0.0.1', $_SERVER['REMOTE_ADDR']);
  else
    exit;
    return $real_ip;
}

function encrypt($password)
{
  $hash_salt = 'xCg532%@%gdvf^5DGaa6&*rFTfg^FD4\$OIFThrR_gh(ugf*/';
  $string = sha1(md5($password.($hash_salt)));
  $string = hash('sha512', $string);
  return str_replace('$2x$07$galaxycmsbyangelrmz', '', crypt($string, '$2x$07$galaxycmsbyangelrmzhash$'));
}

function session_check($require){
  //$scripts = array('/vales/index.php', '/proyects/vales/index.php');
  /*$index=str_replace(str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']), '', PATH_ROOT) . 'index.php';
  $scripts = array(str_replace('\\', '/', $index));
  if($require && !isset($_SESSION['logged'])):
    //unset($_SESSION);
    session_destroy();
    redirect('index.php');
  elseif(isset($_SESSION['logged']) && in_array($_SERVER['SCRIPT_NAME'], $scripts)):
    redirect("home.php");
  endif;*/
}

function escape($value){
  $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
  $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
  return str_replace($search, $replace, $value);
}

function error_logs($desc = '')//$responseType = false
{
  global $app;
  //save log json

  $desc = (empty($desc)) ? error_get_last()['message'] : $desc;

  if(system_apiMode):
    $json['success']=false;
    $json['message']=$desc;
    exit(json_encode($json));
  else:
    $html = "
    <meta charset='UTF-8'>
    <div style='margin: 2ex; padding: 2ex; border: 2px dashed #cc3344; color: black; font-family: tahoma;  font-size: 12px; background-color: #ffe4e9;margin:0;'>
    <div style='float: left; width: 2ex; font-size: 2em; color: red;'>!!</div>
    <strong style='text-decoration: underline;'>Opps!!</strong> $desc</p>";
//getcwd()
    if($error = error_get_last()):
      $file=$error['file'];
      $line=$error['line'];
      $html .= "<div style='padding-left: 3ex;'>This has origin in the file <b>$file</b> / in line: <b>$line</b>.<br><br>";
      error_clear_last();
    endif;

    $html .= "If the problem persists, please report to the <a href='https://www.virtualhost.mx/forum'>forum</a></div>";
    /*if($note):
       $html .= '<div style="padding-left: 6ex;"></br><i>Note: '.$note.'</i></div></div>';
    else  */

    /*if(mysqli_connect_error()):
      $html .= '<span style="padding-left: 6ex;"></br><i>Note: '.mysqli_connect_error().'</i></span></div>';
    endif;*/

    $html .= '<br><p style="text-align:center;font-size:12px;"><i>Copyright &copy 2016 CodeBridge powered by <a href="https://www.facebook.com/asrmdz">AngelRmz</a>. All rights reserved.</i></p></div>';
    ob_get_clean();
    array_push($app['logs'], array(
      'date' => date("d/m/y h:i"),
      'log' => $desc,
      'ip' => remoteIP()
    ));
    file_put_contents(PATH_EXTRADATA . 'app.logs.json', json_encode($app['logs']));
    if(!defined('system_app'))
      exit($html);

  endif;
}
function is_true($val, $return_null=false){
    $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );
    return ( $boolval===null && !$return_null ? false : $boolval ) ? "true" : "false";
}

function realtime(){
  return (system_debug) ? '?' . time() : '';
}

?>
