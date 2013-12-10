<?php
class Tipopergunta_m extends Database { 
	
	// ATRIBUTOS
	protected $idTipopergunta;
	protected $descricaoTipopergunta;
	
	//CONSTRUTOR
	function __construct( $idTipopergunta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTipopergunta) ){
		
			$array = $this -> selectTipopergunta(" WHERE T.id = ".$this -> gravarBD($idTipopergunta) );			
						
			$this -> idTipopergunta = $array[0]['id'];
			$this -> descricaoTipopergunta = $array[0]['descricao'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTipopergunta($valor) {
		$this -> idTipopergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descricaoTipopergunta($valor) {
		$this -> descricaoTipopergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idTipopergunta() {
		return ($this -> idTipopergunta);
	}
	
	function get_descricaoTipopergunta() {
		return ($this -> descricaoTipopergunta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTipopergunta() {
		$sql = "INSERT INTO tipopergunta 
		(descricao) 
		VALUES (	
			" . $this -> descricaoTipopergunta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTipopergunta() {
		
		if( $this -> idTipopergunta ){
			$sql = "DELETE FROM tipopergunta WHERE id = ".$this -> idTipopergunta;			
			return $this -> query($sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	
	}

	function updateTipopergunta() {
		if( $this -> idTipopergunta ){
				
			return $this -> updateCampoTipopergunta(
				array(		
					"descricao" => $this -> descricaoTipopergunta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTipopergunta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTipopergunta && is_array($sets) ){
			$sql = "UPDATE tipopergunta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTipopergunta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTipopergunta($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM tipopergunta AS T ".$where;		
		return $this -> executarQuery($sql);
	}
		
}
