<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class myssql
{
  public $table;
  public $params;// = array();
  public $where;
  private $sqlCmd;
  public $fetch;
  public $rows;
  public $insertId = 0;
  public $db;// = "hola";//solo se pueden user internamente en la clase y cambiar su valor en cualquiera funcion
  public $column_keys;
  public $column_values;
  public $connected=false;

  function __construct()
  {
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
    	$this->db = new mysqli(
        mysql_hostname,
        mysql_username,
        mysql_password,
        mysql_dbname,
        mysql_port
      );
    	$this->db->set_charset(system_charset);
      $this->connected=true;
    } catch (mysqli_sql_exception $e) {
    	 error_logs($e->getMessage());
    }

    $this->where = "";
    $this->column_keys = "";
    $this->column_values = "";

    $this->clean();

  }

  function insert(){
    //INSERT INTO $this->table () VALUES ();
    //comprobar que exista la tabla.. comprobar parametros no empty ??
    $this->sqlCmd="INSERT INTO $this->table ";

    foreach ($this->params as $key => $value):
      $this->column_keys .= "$key,";//poner los comillones?
      $this->column_values .= "\"{$value}\",";
    endforeach;

    $this->column_keys=substr($this->column_keys, 0, -1);
    $this->column_values=substr($this->column_values, 0, -1);

    $this->sqlCmd .= "($this->column_keys) VALUES ";
    $this->sqlCmd .= "($this->column_values);";

    self::execute();

    $this->insertId=$this->db->insert_id;

  }

  function replace(){
    //INSERT INTO $this->table () VALUES ();
    //comprobar que exista la tabla.. comprobar parametros no empty ??
    $this->sqlCmd="REPLACE INTO $this->table ";

    foreach ($this->params as $key => $value):
      $this->column_keys .= "$key,";//poner los comillones?
      $this->column_values .= "\"{$value}\",";
    endforeach;

    $this->column_keys=substr($this->column_keys, 0, -1);
    $this->column_values=substr($this->column_values, 0, -1);

    $this->sqlCmd .= "($this->column_keys) VALUES ";
    $this->sqlCmd .= "($this->column_values);";

    self::execute();

    $this->insertId=$this->db->insert_id;

  }

  function update($values=false){

    $this->sqlCmd="UPDATE $this->table SET ";

    foreach ($this->params as $key => $value):
      if($values):
        $this->column_keys .= (strpos($value, '-') !== false || strpos($value, '+') !== false) ? "`$key`={$value}," : "`$key`=\"{$value}\",";
      else:
        $this->column_keys .= "`$key`=\"{$value}\",";
      endif;
    endforeach;

    $this->column_keys=substr($this->column_keys, 0, -1);

    $this->sqlCmd .= "$this->column_keys WHERE ";

    foreach ($this->where as $key => $value):
      $this->column_values .= "`$key`=\"{$value}\" AND";
    endforeach;

    $this->column_values=substr($this->column_values, 0, -3);

    $this->sqlCmd .= $this->column_values;

    self::execute();

  }


  function fetch($sqlCmd, $force=false){
    $query=self::execute($sqlCmd);

    while($array = $query->fetch_assoc()):
      $this->fetch[] = $array;
    endwhile;

    if($query->num_rows == 1 && $force===false):
      $this->fetch = $this->fetch[0];
    endif;

  }

  function execute($sqlCmd = null){
    $query= $this->db->query( is_null($sqlCmd) ? $this->sqlCmd : $sqlCmd )or die(error_logs($this->db->error));
    $this->rows=isset($query->num_rows) ? $query->num_rows : null;
    //self::clean();
    return $query;
  }

  function clean(){
    // unset($this->sqlCmd);
    // unset($this->params);
    // unset($this->where);
    // unset($this->table);
    // unset($this->insertId);
    // unset($this->rows);
    // unset($this->fetch);
    // unset($this->column_keys);
    // unset($this->column_values);
    $this->sqlCmd="";
    $this->params=array();
    $this->where=array();
    $this->table="";
    $this->insertId=0;
    $this->rows=0;
    $this->fetch=array();
    $this->column_keys = "";
    $this->column_values = "";
  }

  function FilterParams(){
    foreach ($this->params as $key => $value) {
      $this->params[$key]=self::TildeCheck($value);
      $this->params[$key]=self::InjectionCheck($value);
      $this->params[$key]=$this->db->real_escape_string($value);
    }
    if(count($this->where) > 0){
      foreach ($this->where as $key => $value) {
        $this->where[$key]=self::InjectionCheck($value);
        $this->where[$key]=$this->db->real_escape_string($value);
      }
    }
  }

  function InjectionCheck($str)
  {
    $texto = trim($str);
    $texto = stripslashes($texto);
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'utf-8');// htmlspecialchars($texto); //
    $texto = strip_tags($texto);
    $texto = str_replace('"', '&#34;', $texto);
    $texto = str_replace("'", "&#39;", $texto);
    $texto = str_replace("<script", "", $texto);
    $texto = str_replace("(", "", $texto);
    $texto = str_replace(")", "", $texto);
    $texto = str_replace("INSERT","IN-SER-T",$texto);
    $texto = str_replace("DELETE","DE-LE-TE",$texto);
    $texto = str_replace("TRUNCATE","TRUN-CA-TE",$texto);
    $texto = str_replace("SELECT","SE-LEC-T",$texto);
    $texto = str_replace("ALTER","AL-TER",$texto);
    $texto = str_replace("UPDATE","UP-DA-TE",$texto);
    $texto = str_replace("script","",$texto);
    $texto = str_replace("SCRIPT","",$texto);
    $texto = str_replace("location","",$texto);
    $texto = str_replace("body","",$texto);
    $texto = str_replace("<","",$texto);
    $texto = str_replace(">","",$texto);
    $texto = str_replace("/","",$texto);
    $texto = str_replace("&quot;","",$texto);
    $texto = str_replace("&gt;","",$texto);
    $texto = str_replace("&lt;","",$texto);
    $texto = str_replace('\n', "<br />", $texto);
    return $texto;
  }

  function TildeCheck($string){
    $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas= array ("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","c","C","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&uacute;","&oacute;","&Oacute;","&iacute;","&aacute;","&eacute;","&Uacute;","&Iacute;","&Aacute;","&Eacute;");
    return str_replace($no_permitidas, $permitidas ,$string);
  }

  function __destruct(){
    if($this->connected)
      $this->db->close();
  }

}

?>
