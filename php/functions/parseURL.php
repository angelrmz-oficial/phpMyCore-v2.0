<?php
if(!defined('system_webscr') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

function get_tlds() {
    //$address = 'https://publicsuffix.org/list/effective_tld_names.dat?raw=1';

    $content = file(PATH_EXTRADATA . 'effective_tld_names.txt');
    foreach ($content as $num => $line) {
        $line = trim($line);
        if($line == '') continue;
        if(@substr($line[0], 0, 2) == '/') continue;
        $line = @preg_replace("/[^a-zA-Z0-9\.]/", '', $line);
        if($line == '') continue;  //$line = '.'.$line;
        if(@$line[0] == '.') $line = substr($line, 1);
        if(!strstr($line, '.')) continue;
        $subtlds[] = $line;
        //echo "{$num}: '{$line}'"; echo "<br>";
    }

    $subtlds = array_merge(array(
            'co.uk', 'me.uk', 'net.uk', 'org.uk', 'sch.uk', 'ac.uk',
            'gov.uk', 'nhs.uk', 'police.uk', 'mod.uk', 'asn.au', 'com.au',
            'net.au', 'id.au', 'org.au', 'edu.au', 'gov.au', 'csiro.au'
        ), $subtlds);

    $subtlds = array_unique($subtlds);

    return $subtlds;
}


function domain($url)
{
    $slds = "";
    $url = strtolower($url);

    $host = parse_url('http://'.$url,PHP_URL_HOST);

    preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
    foreach(get_tlds() as $sub){
        if (preg_match('/\.'.preg_quote($sub).'$/', $host, $xyz)){
            preg_match("/[^\.\/]+\.[^\.\/]+\.[^\.\/]+$/", $host, $matches);
        }
    }

    return @$matches[0];
}

function baseURL($url){
  return str_replace('www.','',parse_url($url, PHP_URL_HOST));
}

?>
