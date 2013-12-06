<?php
class Database {

	// class attributes
	protected $connect;

	// constructor
	function __construct() {
		$this -> connect(DATABASE_DB);
	}

	// constructor
	function __destruct() {
		//if( $this->connect ) mysql_close($this->connect);
	}

	// class methods
	function connect($database = false) {

		$this -> connect = mysql_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);

		if (!$this -> connect)
			$this -> mostraErr("Erro ao conctar db");

		if ($database) {
			$this -> selectDb($database);
			mysql_set_charset('utf8');
		}

	}

	function selectDb($database) {
		if (!mysql_select_db($database, $this -> connect))
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
			return array(
				false,
				$this -> mostraErr($sql)
			);
		} else {
			return array(
				$query,
				$msg
			);
		}

	}

	function mostraErr($sql = "") {

		if (EMPRESA) {
			$mensagemErro = MSG_ERR;

			/*$emails = array(0 => array(
			 "email" => ENVIO_TESTE,
			 "nome" => "Administrador"
			 ));
			 Uteis::enviarEmail("ERRO SIS", $mensagemErro, $emails);*/

		} else {
			$mensagemErro = "<br />$sql<br />" . mysql_errno($this -> connect) . ": " . mysql_error($this -> connect);

		}
		echo $mensagemErro;
		exit ;
		//return $mensagemErro;
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
