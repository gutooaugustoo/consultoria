<?php
class Backgroundidioma_m extends Database { 
	
	// ATRIBUTOS
	protected $idBackgroundidioma;
	protected $candidato_idBackgroundidioma;
	protected $escola_idBackgroundidioma;
	protected $idioma_idBackgroundidioma;
	protected $haQuantoTempoBackgroundidioma;
	protected $quantoTempoBackgroundidioma;
	protected $obsBackgroundidioma;
	
	//CONSTRUTOR
	function __construct( $idBackgroundidioma = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idBackgroundidioma) ){
		
			$array = $this -> selectBackgroundidioma(" WHERE B.id = ".$this -> gravarBD($idBackgroundidioma) );			
			
			$this -> idBackgroundidioma = $array[0]['id'];
			$this -> candidato_idBackgroundidioma = $array[0]['candidato_id'];
			$this -> escola_idBackgroundidioma = $array[0]['escola_id'];
			$this -> idioma_idBackgroundidioma = $array[0]['idioma_id'];
			$this -> haQuantoTempoBackgroundidioma = $array[0]['haQuantoTempo'];
			$this -> quantoTempoBackgroundidioma = $array[0]['quantoTempo'];
			$this -> obsBackgroundidioma = $array[0]['obs'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idBackgroundidioma($valor) {
		$this -> idBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_idBackgroundidioma($valor) {
		$this -> candidato_idBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escola_idBackgroundidioma($valor) {
		$this -> escola_idBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idBackgroundidioma($valor) {
		$this -> idioma_idBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_haQuantoTempoBackgroundidioma($valor) {
		$this -> haQuantoTempoBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_quantoTempoBackgroundidioma($valor) {
		$this -> quantoTempoBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_obsBackgroundidioma($valor) {
		$this -> obsBackgroundidioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idBackgroundidioma() {
		return ($this -> idBackgroundidioma);
	}
	
	function get_candidato_idBackgroundidioma() {
		return ($this -> candidato_idBackgroundidioma);
	}
	
	function get_escola_idBackgroundidioma() {
		return ($this -> escola_idBackgroundidioma);
	}
	
	function get_idioma_idBackgroundidioma() {
		return ($this -> idioma_idBackgroundidioma);
	}
	
	function get_haQuantoTempoBackgroundidioma() {
		return ($this -> haQuantoTempoBackgroundidioma);
	}
	
	function get_quantoTempoBackgroundidioma() {
		return ($this -> quantoTempoBackgroundidioma);
	}
	
	function get_obsBackgroundidioma() {
		return ($this -> obsBackgroundidioma);
	}
				
	//MANUSEANDO O BANCO
		
	function insertBackgroundidioma() {
		$sql = "INSERT INTO backgroundidioma 
		(candidato_id, escola_id, idioma_id, haQuantoTempo, quantoTempo, obs) 
		VALUES (	
			" . $this -> candidato_idBackgroundidioma . ", 	
			" . $this -> escola_idBackgroundidioma . ", 	
			" . $this -> idioma_idBackgroundidioma . ", 	
			" . $this -> haQuantoTempoBackgroundidioma . ", 	
			" . $this -> quantoTempoBackgroundidioma . ", 	
			" . $this -> obsBackgroundidioma . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteBackgroundidioma() {
		return $this -> updateCampoBackgroundidioma(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateBackgroundidioma() {
		if( $this -> idBackgroundidioma ){
				
			return $this -> updateCampoBackgroundidioma(
				array(		
					"candidato_id" => $this -> candidato_idBackgroundidioma, 		
					"escola_id" => $this -> escola_idBackgroundidioma, 		
					"idioma_id" => $this -> idioma_idBackgroundidioma, 		
					"haQuantoTempo" => $this -> haQuantoTempoBackgroundidioma, 		
					"quantoTempo" => $this -> quantoTempoBackgroundidioma, 		
					"obs" => $this -> obsBackgroundidioma				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoBackgroundidioma($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idBackgroundidioma && is_array($sets) ){
			$sql = "UPDATE backgroundidioma SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idBackgroundidioma;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectBackgroundidioma($where = "", $campos = array("B.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM backgroundidioma AS B ".$where;
		return $this -> executarQuery($sql);
	}
		
}
