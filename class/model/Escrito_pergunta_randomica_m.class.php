<?php
class Escrito_pergunta_randomica_m extends Database { 
	
	// ATRIBUTOS
	protected $idEscrito_pergunta_randomica;
	protected $escrito_idEscrito_pergunta_randomica;
	protected $nivelPergunta_idEscrito_pergunta_randomica;
	protected $categoriaPergunta_idEscrito_pergunta_randomica;
	protected $idioma_idEscrito_pergunta_randomica;
	protected $quantidadeEscrito_pergunta_randomica;
	
	//CONSTRUTOR
	function __construct( $idEscrito_pergunta_randomica = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEscrito_pergunta_randomica) ){
		
			$array = $this -> selectEscrito_pergunta_randomica(" WHERE E.id = ".$this -> gravarBD($idEscrito_pergunta_randomica) );			
			
			$this -> idEscrito_pergunta_randomica = $array[0]['id'];
			$this -> escrito_idEscrito_pergunta_randomica = $array[0]['escrito_id'];
			$this -> nivelPergunta_idEscrito_pergunta_randomica = $array[0]['nivelPergunta_id'];
			$this -> categoriaPergunta_idEscrito_pergunta_randomica = $array[0]['categoriaPergunta_id'];
			$this -> idioma_idEscrito_pergunta_randomica = $array[0]['idioma_id'];
			$this -> quantidadeEscrito_pergunta_randomica = $array[0]['quantidade'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEscrito_pergunta_randomica($valor) {
		$this -> idEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_idEscrito_pergunta_randomica($valor) {
		$this -> escrito_idEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nivelPergunta_idEscrito_pergunta_randomica($valor) {
		$this -> nivelPergunta_idEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_categoriaPergunta_idEscrito_pergunta_randomica($valor) {
		$this -> categoriaPergunta_idEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idEscrito_pergunta_randomica($valor) {
		$this -> idioma_idEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_quantidadeEscrito_pergunta_randomica($valor) {
		$this -> quantidadeEscrito_pergunta_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEscrito_pergunta_randomica() {
		return ($this -> idEscrito_pergunta_randomica);
	}
	
	function get_escrito_idEscrito_pergunta_randomica() {
		return ($this -> escrito_idEscrito_pergunta_randomica);
	}
	
	function get_nivelPergunta_idEscrito_pergunta_randomica() {
		return ($this -> nivelPergunta_idEscrito_pergunta_randomica);
	}
	
	function get_categoriaPergunta_idEscrito_pergunta_randomica() {
		return ($this -> categoriaPergunta_idEscrito_pergunta_randomica);
	}
	
	function get_idioma_idEscrito_pergunta_randomica() {
		return ($this -> idioma_idEscrito_pergunta_randomica);
	}
	
	function get_quantidadeEscrito_pergunta_randomica() {
		return ($this -> quantidadeEscrito_pergunta_randomica);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEscrito_pergunta_randomica() {
		$sql = "INSERT INTO escrito_pergunta_randomica 
		(escrito_id, nivelPergunta_id, categoriaPergunta_id, idioma_id, quantidade) 
		VALUES (	
			" . $this -> escrito_idEscrito_pergunta_randomica . ", 	
			" . $this -> nivelPergunta_idEscrito_pergunta_randomica . ", 	
			" . $this -> categoriaPergunta_idEscrito_pergunta_randomica . ", 	
			" . $this -> idioma_idEscrito_pergunta_randomica . ", 	
			" . $this -> quantidadeEscrito_pergunta_randomica . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEscrito_pergunta_randomica() {
		return $this -> updateCampoEscrito_pergunta_randomica(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEscrito_pergunta_randomica() {
		if( $this -> idEscrito_pergunta_randomica ){
				
			return $this -> updateCampoEscrito_pergunta_randomica(
				array(		
					"escrito_id" => $this -> escrito_idEscrito_pergunta_randomica, 		
					"nivelPergunta_id" => $this -> nivelPergunta_idEscrito_pergunta_randomica, 		
					"categoriaPergunta_id" => $this -> categoriaPergunta_idEscrito_pergunta_randomica, 		
					"idioma_id" => $this -> idioma_idEscrito_pergunta_randomica, 		
					"quantidade" => $this -> quantidadeEscrito_pergunta_randomica				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEscrito_pergunta_randomica($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEscrito_pergunta_randomica && is_array($sets) ){
			$sql = "UPDATE escrito_pergunta_randomica SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEscrito_pergunta_randomica;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEscrito_pergunta_randomica($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM escrito_pergunta_randomica AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
