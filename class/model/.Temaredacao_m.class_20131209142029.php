<?php
class Temaredacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idTemaredacao;
	protected $temaTemaredacao;
	protected $inativoTemaredacao = 0;
	protected $obsTemaredacao;
	
	//CONSTRUTOR
	function __construct( $idTemaredacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTemaredacao) ){
		
			$array = $this -> selectTemaredacao(" WHERE T.id = ".$this -> gravarBD($idTemaredacao) );			
			
			$this -> idTemaredacao = $array[0]['id'];
			$this -> temaTemaredacao = $array[0]['tema'];
			$this -> inativoTemaredacao = $array[0]['inativo'];
			$this -> obsTemaredacao = $array[0]['obs'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTemaredacao($valor) {
		$this -> idTemaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_temaTemaredacao($valor) {
		$this -> temaTemaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoTemaredacao($valor) {
		$this -> inativoTemaredacao = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_obsTemaredacao($valor) {
		$this -> obsTemaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idTemaredacao() {
		return ($this -> idTemaredacao);
	}
	
	function get_temaTemaredacao() {
		return ($this -> temaTemaredacao);
	}
	
	function get_inativoTemaredacao($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoTemaredacao : Uteis::exibirStatus(!$this -> inativoTemaredacao);
	}
	
	function get_obsTemaredacao() {
		return ($this -> obsTemaredacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTemaredacao() {
		$sql = "INSERT INTO temaredacao 
		(tema, inativo, obs) 
		VALUES (	
			" . $this -> temaTemaredacao . ", 	
			" . $this -> inativoTemaredacao . ", 	
			" . $this -> obsTemaredacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTemaredacao() {
		return $this -> updateCampoTemaredacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateTemaredacao() {
		if( $this -> idTemaredacao ){
				
			return $this -> updateCampoTemaredacao(
				array(		
					"tema" => $this -> temaTemaredacao, 		
					"inativo" => $this -> inativoTemaredacao, 		
					"obs" => $this -> obsTemaredacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTemaredacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTemaredacao && is_array($sets) ){
			$sql = "UPDATE temaredacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTemaredacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTemaredacao($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM temaredacao AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
