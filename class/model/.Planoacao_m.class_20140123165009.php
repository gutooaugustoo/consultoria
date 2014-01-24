<?php
class Planoacao_m extends Database { 
	
	// ATRIBUTOS
	
	//CONSTRUTOR
	function __construct( $idPlanoacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPlanoacao) ){
		
			$array = $this -> selectPlanoacao(" WHERE P.id = ".$this -> gravarBD($idPlanoacao) );			
			
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
		
	//GETS
				
	//MANUSEANDO O BANCO
		
	function insertPlanoacao() {
		$sql = "INSERT INTO planoacao 
		() 
		VALUES (
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePlanoacao() {
		
		if( $this -> idPlanoacao ){
			$sql = "DELETE FROM planoacao WHERE id = ".$this -> idPlanoacao;			
			return $this -> query($sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	
	}

	function updatePlanoacao() {
		if( $this -> idPlanoacao ){
				
			return $this -> updateCampoPlanoacao(
				array(				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPlanoacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPlanoacao && is_array($sets) ){
			$sql = "UPDATE planoacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPlanoacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPlanoacao($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM planoacao AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
