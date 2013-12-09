<?php
class Temaredacao_m extends Database { 
	
	// ATRIBUTOS
	
	//CONSTRUTOR
	function __construct( $idTemaredacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTemaredacao) ){
		
			$array = $this -> selectTemaredacao(" WHERE T.id = ".$this -> gravarBD($idTemaredacao) );			
			
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
		
	//GETS
				
	//MANUSEANDO O BANCO
		
	function insertTemaredacao() {
		$sql = "INSERT INTO temaredacao 
		() 
		VALUES (
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTemaredacao() {
		
		if( $this -> idTemaredacao ){
			$sql = "DELETE FROM temaredacao WHERE id = ".$this -> idTemaredacao;			
			return $this -> query($sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	
	}

	function updateTemaredacao() {
		if( $this -> idTemaredacao ){
				
			return $this -> updateCampoTemaredacao(
				array(				
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
