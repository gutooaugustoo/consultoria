<?php
class Nivelcandidato_m extends Database { 
	
	// ATRIBUTOS
	protected $idNivelcandidato;
	protected $nivelNivelcandidato;
	protected $inativoNivelcandidato = 0;
	
	//CONSTRUTOR
	function __construct( $idNivelcandidato = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idNivelcandidato) ){
		
			$array = $this -> selectNivelcandidato(" WHERE N.id = ".$this -> gravarBD($idNivelcandidato) );			
			
			$this -> idNivelcandidato = $array[0]['id'];
			$this -> nivelNivelcandidato = $array[0]['nivel'];
			$this -> inativoNivelcandidato = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idNivelcandidato($valor) {
		$this -> idNivelcandidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nivelNivelcandidato($valor) {
		$this -> nivelNivelcandidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoNivelcandidato($valor) {
		$this -> inativoNivelcandidato = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idNivelcandidato() {
		return ($this -> idNivelcandidato);
	}
	
	function get_nivelNivelcandidato() {
		return ($this -> nivelNivelcandidato);
	}
	
	function get_inativoNivelcandidato($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoNivelcandidato : Uteis::exibirStatus(!$this -> inativoNivelcandidato);
	}
				
	//MANUSEANDO O BANCO
		
	function insertNivelcandidato() {
		$sql = "INSERT INTO nivelcandidato 
		(nivel, inativo) 
		VALUES (	
			" . $this -> nivelNivelcandidato . ", 	
			" . $this -> inativoNivelcandidato . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteNivelcandidato() {
		return $this -> updateCampoNivelcandidato(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateNivelcandidato() {
		if( $this -> idNivelcandidato ){
				
			return $this -> updateCampoNivelcandidato(
				array(		
					"nivel" => $this -> nivelNivelcandidato, 		
					"inativo" => $this -> inativoNivelcandidato				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoNivelcandidato($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idNivelcandidato && is_array($sets) ){
			$sql = "UPDATE nivelcandidato SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idNivelcandidato;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectNivelcandidato($where = "", $campos = array("N.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM nivelcandidato AS N ".$where;
		return $this -> executarQuery($sql);
	}
		
}
