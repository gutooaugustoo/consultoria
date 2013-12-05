<?php
class Gestor_m extends Pessoa { 
	
	// ATRIBUTOS
	protected $idGestor;
	protected $empresa_idGestor;
	
	//CONSTRUTOR
	function __construct( $idGestor = "" ) {
		
		parent::__construct($idGestor);
		
		if( is_numeric($idGestor) ){
		
			$array = $this -> selectGestor(" WHERE G.id = ".$this -> gravarBD($idGestor) );			
			
			$this -> idGestor = $array[0]['id'];
			$this -> empresa_idGestor = $array[0]['empresa_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idGestor($valor) {
		$this -> idGestor = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idGestor($valor) {
		$this -> empresa_idGestor = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idGestor() {
		return ($this -> idGestor);
	}
	
	function get_empresa_idGestor() {
		return ($this -> empresa_idGestor);
	}
				
	//MANUSEANDO O BANCO
		
	function insertGestor() {
		$sql = "INSERT INTO gestor (id, empresa_id) 
		VALUES (
			" . $this -> idGestor . ", 
			" . $this -> empresa_idGestor . "
		)";
		
		if( $this -> query($sql) ){
			return array(
				$this -> idGestor,
				MSG_CADNEW
			);
		}else{
			return array(false, MSG_ERR);
		}		
	}
		
	function updateGestor() {
		if( $this -> idGestor ){				
			//return $this -> updateCampoGestor( array("empresa_id" => $this -> empresa_idGestor) );
			return array(
				$this -> idGestor,
				MSG_CADUP
			);			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoGestor($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idGestor && is_array($sets) ){
			$sql = "UPDATE gestor SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idGestor;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectGestor($where = "", $campos = array("G.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM gestor AS G 
		INNER JOIN pessoa AS P ON P.id = G.id ".$where;
		return $this -> executarQuery($sql);
	}
		
}
