<?php require 'post.logged.php';
if(!in_array("mysql", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$conn = new mysqli(mysql_hostname, mysql_username, mysql_password, mysql_dbname, mysql_port);
$conn->close();

$conn->query("SET GLOBAL sql_mode='{$post['mode']}'")or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => null)));

die(json_encode(array("success" => true, "message" => "SQL Mode actualizado con éxito!", "errorCode" => null)));

?>
