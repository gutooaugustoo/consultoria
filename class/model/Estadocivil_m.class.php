<?php
class Estadocivil_m extends Database { 
	
	// ATRIBUTOS
	protected $idEstadocivil;
	protected $nomeEstadocivil;
	
	//CONSTRUTOR
	function __construct( $idEstadocivil = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEstadocivil) ){
		
			$array = $this -> selectEstadocivil(" WHERE id = ".$this -> gravarBD($idEstadocivil) );			
			
			$this -> idEstadocivil = $array[0]['id'];
			$this -> nomeEstadocivil = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEstadocivil($valor) {
		$this -> idEstadocivil = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeEstadocivil($valor) {
		$this -> nomeEstadocivil = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEstadocivil() {
		return ($this -> idEstadocivil);
	}
	
	function get_nomeEstadocivil() {
		return ($this -> nomeEstadocivil);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEstadocivil() {
		$sql = "INSERT INTO estadocivil (nome) 
		VALUES ($this -> nomeEstadocivil)";
		if( $this -> query($sql) ){
			return mysql_insert_id($this -> connect, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEstadocivil() {
		
	if( $this -> idEstadocivil ){
		$sql = "DELETE FROM estadocivil WHERE id = ".$this -> idEstadocivil;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updateEstadocivil() {
		if( $this -> idEstadocivil ){
				
			return $this -> updateCampoEstadocivil(
				array(		
					"nome" => $this -> nomeEstadocivil				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEstadocivil($sets = array(), $msg) {		
		if( $this -> idEstadocivil && is_array($sets) ){
			$sql = "UPDATE estadocivil SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEstadocivil;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEstadocivil($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM estadocivil AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
