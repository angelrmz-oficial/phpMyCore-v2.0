<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class recaptchav2
{
  function validate($response){

    $postdata = http_build_query(
        array(
            'secret' => RECAPTCHAV2_API_KEY,
            'response' => $response
        )
    );

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );

    $context  = stream_context_create($opts);
    $result = file_get_contents(RECAPTCHAV2_API_SERVER, false, $context);
    $captcha_success=json_decode($result);

  	return $captcha_success->success;
  }

}
?>
