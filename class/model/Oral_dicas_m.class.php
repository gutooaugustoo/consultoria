<?php
class Oral_dicas_m extends Database { 
	
	// ATRIBUTOS
	protected $idOral_dicas;
	protected $oral_idOral_dicas;
	protected $dicasEntrevista_idOral_dicas;
	
	//CONSTRUTOR
	function __construct( $idOral_dicas = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idOral_dicas) ){
		
			$array = $this -> selectOral_dicas(" WHERE O.id = ".$this -> gravarBD($idOral_dicas) );			
			
			$this -> idOral_dicas = $array[0]['id'];
			$this -> oral_idOral_dicas = $array[0]['oral_id'];
			$this -> dicasEntrevista_idOral_dicas = $array[0]['dicasEntrevista_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idOral_dicas($valor) {
		$this -> idOral_dicas = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_oral_idOral_dicas($valor) {
		$this -> oral_idOral_dicas = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dicasEntrevista_idOral_dicas($valor) {
		$this -> dicasEntrevista_idOral_dicas = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idOral_dicas() {
		return ($this -> idOral_dicas);
	}
	
	function get_oral_idOral_dicas() {
		return ($this -> oral_idOral_dicas);
	}
	
	function get_dicasEntrevista_idOral_dicas() {
		return ($this -> dicasEntrevista_idOral_dicas);
	}
				
	//MANUSEANDO O BANCO
		
	function insertOral_dicas() {
		$sql = "INSERT INTO oral_dicas 
		(oral_id, dicasEntrevista_id) 
		VALUES (	
			" . $this -> oral_idOral_dicas . ", 	
			" . $this -> dicasEntrevista_idOral_dicas . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteOral_dicas() {
		return $this -> updateCampoOral_dicas(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateOral_dicas() {
		if( $this -> idOral_dicas ){
				
			return $this -> updateCampoOral_dicas(
				array(		
					"oral_id" => $this -> oral_idOral_dicas, 		
					"dicasEntrevista_id" => $this -> dicasEntrevista_idOral_dicas				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoOral_dicas($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idOral_dicas && is_array($sets) ){
			$sql = "UPDATE oral_dicas SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idOral_dicas;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectOral_dicas($where = "", $campos = array("O.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM oral_dicas AS O ".$where;
		return $this -> executarQuery($sql);
	}
		
}
