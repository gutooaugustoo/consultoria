<?php
class Modulo extends Database {

	// ATRIBUTOS
	protected $id;
	protected $tipoUsuario_id;
	protected $modulo_id;
	protected $nome;
	protected $ordem;
	protected $link = "#";

	//CONSTRUTOR
	function __construct($id = "") {

		parent::__construct();

		if (is_numeric($id)) {

			$array = $this -> select(" WHERE id = " . $this -> gravarBD($id));

			$this -> id = $array[0]['id'];
			$this -> tipoUsuario_id = $array[0]['tipoUsuario_id'];
			$this -> modulo_id = $array[0]['modulo_id'];
			$this -> nome = $array[0]['nome'];
			$this -> ordem = $array[0]['ordem'];
			$this -> link = $array[0]['link'];

		}
	}

	function __destruct() {
		parent::__destruct();
	}

	//GETS

	function get_id() {
		return ($this -> id);
	}

	function get_tipoUsuario_id() {
		return ($this -> tipoUsuario_id);
	}

	function get_modulo_id() {
		return ($this -> modulo_id);
	}

	function get_nome() {
		return ($this -> nome);
	}

	function get_ordem() {
		return ($this -> ordem);
	}

	function get_link() {
		return ($this -> link);
	}

	//INTERAÇÃO COM O BANCO

	function select($where = "", $campos = array("*")) {
		$sql = "SELECT SQL_CACHE " . implode(",", $campos) . " FROM modulo " . $where;
		return $this -> executarQuery($sql);
	}

	function selectModulo_permissao($tipo, $where = "", $id_session = "") {

		$sqlBase = "SELECT SQL_CACHE M.id, M.modulo_id, M.nome, M.link
		FROM modulo AS M ";

		if ($tipo == "candidato") {

			$sql = $sqlBase . " WHERE M.tipoUsuario_id = 4 ";

		} elseif ($tipo == "gestor") {

			$sql = $sqlBase . " WHERE M.tipoUsuario_id = 3 ";

		} elseif ($tipo == "avaliador") {

			$sql = $sqlBase . " WHERE M.tipoUsuario_id = 2 ";

		} elseif ($tipo == "funcionario") {

			/*$sql = $sqlBase . "
			INNER JOIN funcionario_modulo AS FM ON FM.modulo_id = M.id AND FM.excluido = 0
			INNER JOIN funcionario AS F ON F.id = FM.funcionario_id
			INNER JOIN pessoa AS P ON P.id = F.id AND P.id = " . $id_session . "  
			WHERE M.tipoUsuario_id = 1 ";*/
			$sql = $sqlBase . " WHERE M.tipoUsuario_id = 1 ";
		}

		$sql .= $where . " ORDER BY M.ordem ASC, M.nome ASC ";
		//echo "<br>".$sql;
		return $this -> executarQuery($sql);
	}

}
