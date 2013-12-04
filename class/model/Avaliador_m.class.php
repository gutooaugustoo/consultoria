<?php
class Avaliador_m extends Pessoa {

	// ATRIBUTOS
	protected $idAvaliador;

	//CONSTRUTOR
	function __construct($idAvaliador = "") {

		parent::__construct($idAvaliador);

		if (is_numeric($idAvaliador)) {

			$array = $this -> selectAvaliador(" WHERE A.id = " . $this -> gravarBD($idAvaliador));

			$this -> idAvaliador = $array[0]['id'];

		}
	}

	function __destruct() {
		parent::__destruct();
	}

	//SETS

	function set_idAvaliador($valor) {
		$this -> idAvaliador = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}

	//GETS

	function get_idAvaliador() {
		return ($this -> idAvaliador);
	}

	//MANUSEANDO O BANCO

	function insertAvaliador() {
		$sql = "INSERT INTO avaliador (id) VALUES (" . $this -> idAvaliador . ")";
		if ($rs = $this -> query($sql)) {
			return array(
				$this -> idAvaliador,
				MSG_CADNEW
			);
		} else {
			return array(
				false,
				MSG_ERR
			);
		}
	}

	function deleteAvaliador() {

		if ($this -> idAvaliador) {
			$sql = "DELETE FROM avaliador WHERE id = " . $this -> idAvaliador;
			return $this -> query($sql, MSG_CADDEL);
		} else {
			return array(
				false,
				MSG_ERR
			);
		}

	}

	function updateAvaliador() {
		if ($this -> idAvaliador) {
			//return $this -> updateCampoAvaliador(array("id" => $this -> idAvaliador));
			return array(
				$this -> idAvaliador,
				MSG_CADUP
			);
		} else {
			return array(
				false,
				MSG_ERR
			);
		}
	}

	function updateCampoAvaliador($sets = array(), $msg = MSG_CADUP) {
		if ($this -> idAvaliador && is_array($sets)) {
			$sql = "UPDATE avaliador SET " . Uteis::montarUpdate($sets) . " WHERE id = " . $this -> idAvaliador;
			return $this -> query($sql, $msg);
		} else {
			return array(
				false,
				MSG_ERR
			);
		}
	}

	function selectAvaliador($where = "", $campos = array("A.*")) {
		$sql = "SELECT SQL_CACHE " . implode(",", $campos) . " FROM avaliador AS A 
		INNER JOIN pessoa AS P ON P.id = A.id " . $where;
		return $this -> executarQuery($sql);
	}

}
