<?php require 'post.logged.php';
if(!in_array("mysql", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$conn = new mysqli(mysql_hostname, mysql_username, mysql_password, mysql_dbname, mysql_port);

if($conn->connect_error)
  die(json_encode(array("success" => false, "message" => "Error! No fue posible realizar la conexión", "errorCode" => null)));

$check=$conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$post['backup_name']}'");
if($check->num_rows > 0)
  die(json_encode(array("success" => false, "message" => "Ya éxiste una base de datos con este nombre", "errorCode" => null)));

//$conn->query("DROP DATABASE IF EXISTS `{$post['backup_name']}`")or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
$conn->query("CREATE DATABASE IF NOT EXISTS `{$post['backup_name']}`")or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
$conn->select_db($post['backup_name'])or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
foreach ($post['tables'] as $table) {
  $conn->query("CREATE TABLE ".$post['backup_name'].".".$table." LIKE ".mysql_dbname.".".$table)or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
  $conn->query("INSERT INTO ".$post['backup_name'].".".$table." SELECT * FROM ".mysql_dbname.".".$table)or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
}

/*$tables=$conn->query("SHOW TABLES")or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
$conn->select_db($post['backup_name'])or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
while ($row = $tables->fetch_row()){
  $conn->query("CREATE TABLE ".$post['backup_name'].".".$row[0]." LIKE ".mysql_dbname.".".$row[0])or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
  $conn->query("INSERT INTO ".$post['backup_name'].".".$row[0]." SELECT * FROM ".mysql_dbname.".".$row[0])or die(json_encode(array("success" => false, "message" => $conn->error, "errorCode" => "queryError")));
}*/

$conn->close();

die(json_encode(array("success" => true, "message" => "Respaldo realizado con éxito!", "errorCode" => null)));


?>
