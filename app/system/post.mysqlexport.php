<?php require 'post.logged.php';
if(!in_array("mysql", $userApp['permissions']))
  die(json_encode(array("success" => false, "message" => "No tiene permiso necesario para realizar esta acción", "errorCode" => "unauthorized")));

$conn = new mysqli(mysql_hostname, mysql_username, mysql_password, mysql_dbname, mysql_port);

if($conn->connect_error)
  die(json_encode(array("success" => false, "message" => "Error! No fue posible realizar la conexión", "errorCode" => null)));


set_time_limit(3000);
$tablasARespaldar = [];

$conn->query("SET NAMES 'utf8'");
$tablas = $conn->query('SHOW TABLES');
while ($fila = $tablas->fetch_row()) {
  $tablasARespaldar[] = $fila[0];
}
$contenido = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $nombreDeBaseDeDatos . "`\r\n--\r\n\r\n\r\n";
foreach ($tablasARespaldar as $nombreDeLaTabla) {
  if (empty($nombreDeLaTabla)) {
      continue;
  }
  $datosQueContieneLaTabla = $conn->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
  $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
  $cantidadDeFilas = $conn->affected_rows;
  $esquemaDeTabla = $conn->query('SHOW CREATE TABLE ' . $nombreDeLaTabla);
  $filaDeTabla = $esquemaDeTabla->fetch_row();
  $contenido .= "\n\n" . $filaDeTabla[1] . ";\n\n";
  for ($i = 0, $contador = 0; $i < $cantidadDeCampos; $i++, $contador = 0) {
      while ($fila = $datosQueContieneLaTabla->fetch_row()) {
          //La primera y cada 100 veces
          if ($contador % 100 == 0 || $contador == 0) {
              $contenido .= "\nINSERT INTO " . $nombreDeLaTabla . " VALUES";
          }
          $contenido .= "\n(";
          for ($j = 0; $j < $cantidadDeCampos; $j++) {
              $fila[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
              if (isset($fila[$j])) {
                  $contenido .= '"' . $fila[$j] . '"';
              } else {
                  $contenido .= '""';
              }
              if ($j < ($cantidadDeCampos - 1)) {
                  $contenido .= ',';
              }
          }
          $contenido .= ")";
          # Cada 100...
          if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $cantidadDeFilas) {
              $contenido .= ";";
          } else {
              $contenido .= ",";
          }
          $contador = $contador + 1;
      }
  }
  $contenido .= "\n\n\n";
}
$contenido .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";


$carpeta = __DIR__ . "/dbexports";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }

    # Calcular un ID único
    $id = uniqid();

    # También la fecha
    $fecha = date("Y-m-d");

    # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
    $nombreDelArchivo = sprintf('%s/export_%s_%s.sql', $carpeta, $fecha, $id);

    #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
/*$check=$conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$post['backup_name']}'");
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
$r=(file_put_contents($nombreDelArchivo, $contenido) !== false) ? true : false;
die(json_encode(array("success" => $r, "message" => ($r == true) ? "Respaldo realizado con éxito!" : "Opps algo salio mal", "errorCode" => null)));


?>
