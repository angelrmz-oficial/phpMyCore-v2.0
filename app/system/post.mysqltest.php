<?php require 'post.logged.php';
if(!in_array("mysql", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$conn = new mysqli(mysql_hostname, mysql_username, mysql_password, mysql_dbname, mysql_port);
$conn->close();
die(json_encode(array("success" => false, "message" => ($conn->connect_error) ? "Error! No fue posible realizar la conexión" : "Conexión establecida con éxito!", "errorCode" => null)));

?>
