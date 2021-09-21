<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class sockets
{

	function __construct($server_ip,$server_port){
		$this->socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		socket_connect($this->socket, $server_ip, $server_port) or die("Could not connect to server\n");
	}

	function socket_cmd($action, $exp){

			$socket_cmd = $action . chr(1);
			$socket_cmd.= $exp;

			socket_write($this->socket, $socket_cmd, strlen($socket_cmd)) or die("Could not send data to server\n");
			return fread($this->socket);
	}

	function __destruct(){
		socket_close($this->socket);
	}
}
?>
