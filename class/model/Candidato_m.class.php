<?php
class Candidato_m extends Pessoa { 
	
	// ATRIBUTOS
	protected $idCandidato;
	
	//CONSTRUTOR
	function __construct( $idCandidato = "" ) {
		
		parent::__construct($idCandidato);
		
		if( is_numeric($idCandidato) ){
		
			$array = $this -> selectCandidato(" WHERE C.id = ".$this -> gravarBD($idCandidato) );			
			
			$this -> idCandidato = $array[0]['id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCandidato($valor) {
		$this -> idCandidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato() {
		return ($this -> idCandidato);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato() {
		$sql = "INSERT INTO candidato (id) VALUES (" . $this -> idCandidato . ")";		
		if( $this -> query($sql) ){
			return array(
				$this -> idAvaliador,
				MSG_CADNEW
			);
		}else{
			return array(false, MSG_ERR);
		}		
	}

	function updateCandidato() {
		if( $this -> idCandidato ){
			//return $this -> updateCampoCandidato(array("id" => $this -> idCandidato));
			return array(
				$this -> idCandidato,
				MSG_CADUP
			);
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCandidato($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCandidato && is_array($sets) ){
			$sql = "UPDATE candidato SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCandidato;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato AS C 
		INNER JOIN pessoa AS P ON P.id = C.id ".$where;
		return $this -> executarQuery($sql);
	}
		
}
