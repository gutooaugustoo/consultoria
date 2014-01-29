<?php
class Etapa_m extends Database { 
	
	// ATRIBUTOS
	protected $idEtapa;
	protected $etapaEtapa;
	
	//CONSTRUTOR
	function __construct( $idEtapa = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEtapa) ){
		
			$array = $this -> selectEtapa(" WHERE E.id = ".$this -> gravarBD($idEtapa) );			
			
			$this -> idEtapa = $array[0]['id'];
			$this -> etapaEtapa = $array[0]['etapa'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEtapa($valor) {
		$this -> idEtapa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_etapaEtapa($valor) {
		$this -> etapaEtapa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEtapa() {
		return ($this -> idEtapa);
	}
	
	function get_etapaEtapa() {
		return ($this -> etapaEtapa);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEtapa() {
		$sql = "INSERT INTO etapa 
		(etapa) 
		VALUES (	
			" . $this -> etapaEtapa . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEtapa() {
		
		if( $this -> idEtapa ){
			$sql = "DELETE FROM etapa WHERE id = ".$this -> idEtapa;			
			return $this -> query($sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	
	}

	function updateEtapa() {
		if( $this -> idEtapa ){
				
			return $this -> updateCampoEtapa(
				array(		
					"etapa" => $this -> etapaEtapa				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEtapa($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEtapa && is_array($sets) ){
			$sql = "UPDATE etapa SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEtapa;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEtapa($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM etapa AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
