<?php
class Pais_m extends Database { 
	
	// ATRIBUTOS
	protected $idPais;
	protected $nacionalidadePais;
	protected $paisPais;
	
	//CONSTRUTOR
	function __construct( $idPais = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPais) ){
		
			$array = $this -> selectPais(" WHERE P.id = ".$this -> gravarBD($idPais) );			
			
			$this -> idPais = $array[0]['id'];
			$this -> nacionalidadePais = $array[0]['nacionalidade'];
			$this -> paisPais = $array[0]['pais'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPais($valor) {
		$this -> idPais = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nacionalidadePais($valor) {
		$this -> nacionalidadePais = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_paisPais($valor) {
		$this -> paisPais = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idPais() {
		return ($this -> idPais);
	}
	
	function get_nacionalidadePais() {
		return ($this -> nacionalidadePais);
	}
	
	function get_paisPais() {
		return ($this -> paisPais);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPais() {
		$sql = "INSERT INTO pais (nacionalidade, pais) 
		VALUES ($this -> nacionalidadePais, $this -> paisPais)";
		if( $this -> query($sql) ){
			return mysql_insert_id($this -> connectDB, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePais() {
		
	if( $this -> idPais ){
		$sql = "DELETE FROM pais WHERE id = ".$this -> idPais;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updatePais() {
		if( $this -> idPais ){
				
			return $this -> updateCampoPais(
				array(		
					"nacionalidade" => $this -> nacionalidadePais, 		
					"pais" => $this -> paisPais				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPais($sets = array(), $msg) {		
		if( $this -> idPais && is_array($sets) ){
			$sql = "UPDATE pais SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPais;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPais($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM pais AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
