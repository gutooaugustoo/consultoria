<?php
class Descricaotelefone_m extends Database { 
	
	// ATRIBUTOS
	protected $idDescricaotelefone;
	protected $nomeDescricaotelefone;
	
	//CONSTRUTOR
	function __construct( $idDescricaotelefone = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idDescricaotelefone) ){
		
			$array = $this -> selectDescricaotelefone(" WHERE D.id = ".$this -> gravarBD($idDescricaotelefone) );			
			
			$this -> idDescricaotelefone = $array[0]['id'];
			$this -> nomeDescricaotelefone = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idDescricaotelefone($valor) {
		$this -> idDescricaotelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeDescricaotelefone($valor) {
		$this -> nomeDescricaotelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idDescricaotelefone() {
		return ($this -> idDescricaotelefone);
	}
	
	function get_nomeDescricaotelefone() {
		return ($this -> nomeDescricaotelefone);
	}
				
	//MANUSEANDO O BANCO
		
	function insertDescricaotelefone() {
		$sql = "INSERT INTO descricaotelefone 
		(nome) 
		VALUES (	
			" . $this -> nomeDescricaotelefone . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteDescricaotelefone() {
		return $this -> updateCampoDescricaotelefone(array("D.excluido" => "1"), MSG_CADDEL);
	}

	function updateDescricaotelefone() {
		if( $this -> idDescricaotelefone ){
				
			return $this -> updateCampoDescricaotelefone(
				array(		
					"nome" => $this -> nomeDescricaotelefone				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoDescricaotelefone($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idDescricaotelefone && is_array($sets) ){
			$sql = "UPDATE descricaotelefone SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idDescricaotelefone;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectDescricaotelefone($where = "", $campos = array("D.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM descricaotelefone AS D ".$where;
		return $this -> executarQuery($sql);
	}
		
}
