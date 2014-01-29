<?php
class Database {

  // class attributes
  private $connectDB;
  private $serverDB;
  private $databaseDB;
  private $userDB;
  private $passwordDB;
  private $errDB = 0;

  // constructor
  function __construct() {
    if (!EMPRESA) {//LOCALHOST
      $this -> serverDB = "localhost";
      $this -> databaseDB = "consultoria";
      $this -> userDB = "root";
      $this -> passwordDB = "";
    } elseif (EMPRESA == "CIA") {//BD OFICIAL DA COMPANHIA DE IDIOMAS
      $this -> serverDB = "186.202.152.113";
      $this -> databaseDB = "companhiadeidi23";
      $this -> userDB = "companhiadeidi23";
      $this -> passwordDB = "con1456@";
    }
    $this -> connect();
  }

  // constructor
  function __destruct() {

  }

  // class methods
  function connect() {

    $this -> connectDB = mysql_connect($this -> serverDB, $this -> userDB, $this -> passwordDB);

    if (!$this -> connectDB)
      $this -> mostraErr("Erro ao conctar db");

    $this -> selectDb();
    mysql_set_charset('utf8');

  }

  function selectDb() {
    if (!mysql_select_db($this -> databaseDB, $this -> connectDB))
      $this -> mostraErr("Erro ao selecionar db");
  }

  function fetchArray($result) {
    if (!$result) {
      return false;
    } else {
      $array = array_map("stripslashes", mysql_fetch_array($result, MYSQL_ASSOC));
      return $array;
    }
  }

  function query($sql, $msg = "") {

    if (!($query = mysql_query($sql))) {
      return array(false, $this -> mostraErr($sql));
    } else {
      return array($query, $msg);
    }

  }

  function mostraErr($sql = "") {

    if (EMPRESA) {
      $mensagemErro = MSG_ERR;
      //$mensagemErro = "<br />$sql<br />" . mysql_errno($this -> connect) . ": " . mysql_error($this -> connect);
      return $mensagemErro;

      //$emails = array(0 => array(			 "email" => ENVIO_TESTE,			 "nome" => "Administrador"			 ));
      //Uteis::enviarEmail("ERRO SIS", $mensagemErro, $emails);

    } else {
      $mensagemErro = "<br />$sql<br />" . mysql_errno($this -> connectDB) . ": " . mysql_error($this -> connectDB);
      echo $mensagemErro;
      exit ;
    }

  }

  function numRows($result) {
    if (!$result) {
      return false;
    } else {
      return mysql_num_rows($result);
    }
  }

  function executarQuery($sql) {
    $result = $this -> query($sql);
    $result = $result[0];
    $array = array();
    for ($i = 0; $i < $this -> numRows($result); $i++) {
      $array[$i] = $this -> fetchArray($result);
    }
    mysql_free_result($result);
    return $array;
  }

  function gravarBD($texto) {

    $res = mysql_real_escape_string(trim($texto));

    if (is_numeric($res)) {
      return $res;
    } elseif (is_null($res) || $res === '' || $res == "NULL") {
      return "NULL";
    } else {
      return "'" . $res . "'";
    }

  }

}
