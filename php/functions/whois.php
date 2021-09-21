<?php
if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

function WOIS($Dominio, $Ext){

  $Dominio.=$Ext;

  /* $WhoisLinks = array
  (
    '.com' => array('whois.crsnic.net','No match for'),//.com
    '.net' => array('whois.crsnic.net','No match for'),// .net
    '.bo' => array('whois.nic.bo','whois.nic.bo solo acepta consultas con dominios .bo'),//.bo
    '.mx' => array('whois.nic.mx','No_Se_Encontro_El_Objeto'),//.mx
    '.pe' => array('whois.nic.pe','No Object Found'),//.pe
    '.us' => array('whois.nic.us','No Data Found'),//.pe
    '.tk' => array('whois.dot.tk','Invalid query'),//.pe
    '.ga' => array('whois.dot.ga','Invalid query'),//.pe
    '.org' => array('whois.pir.org','NOT FOUND'),//.pe
    '.eu' => array('whois.crsnic.net','No match for'),//.pe
    '.es' => array('whois.crsnic.net','No match for')
  );*/
  $WhoisLinks= json_decode(file_get_contents(KERNEL.'whois.servers.json'), true);

  $_ext=explode(".", $Ext);

  $extens = $_ext[1];

  $extens.=(isset($_ext[2])) ? ".".$_ext[2] : "";

  $Whois=$WhoisLinks[$extens];
  $CheckURL=$Whois[0];

	$stringDatoWois="";
	$Mostrar=array();

  $sock       = fsockopen($CheckURL, 43);

	if(!$sock){
    $Mostrar[0]=false;
	}
  else
  {
   	$Mostrar[0]=true;
    fwrite($sock, $Dominio."\r\n");
		while(!feof($sock) ){
		  	$stringDatoWois .= fgetss($sock,128);
		}
    fclose($sock);
    $Mostrar[1]=$stringDatoWois;
  }
  //return $Mostrar;
  $DatoSWois=$Mostrar[1];

  if($Ext==".bo")
  {
    $DatoSWois=str_replace(array("\r\n", "\n", "\r"), '', $DatoSWois);
     if($DatoSWois==$Whois[1]){
       return true;
    }else{
        return false;
    }
  }else{
    //Buscamos
    if (preg_match("/".$Whois[1]."/i",$DatoSWois)){
        return true;
      }else{
        return false;
      }
  }
}
?>
