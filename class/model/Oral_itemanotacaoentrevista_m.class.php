<?php
class Oral_itemanotacaoentrevista_m extends Database { 
	
	// ATRIBUTOS
	protected $idOral_itemanotacaoentrevista;
	protected $oral_idOral_itemanotacaoentrevista;
	protected $item_anotacaoEntrevista_idOral_itemanotacaoentrevista;
	
	//CONSTRUTOR
	function __construct( $idOral_itemanotacaoentrevista = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idOral_itemanotacaoentrevista) ){
		
			$array = $this -> selectOral_itemanotacaoentrevista(" WHERE O.id = ".$this -> gravarBD($idOral_itemanotacaoentrevista) );			
			
			$this -> idOral_itemanotacaoentrevista = $array[0]['id'];
			$this -> oral_idOral_itemanotacaoentrevista = $array[0]['oral_id'];
			$this -> item_anotacaoEntrevista_idOral_itemanotacaoentrevista = $array[0]['item_anotacaoEntrevista_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idOral_itemanotacaoentrevista($valor) {
		$this -> idOral_itemanotacaoentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_oral_idOral_itemanotacaoentrevista($valor) {
		$this -> oral_idOral_itemanotacaoentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_item_anotacaoEntrevista_idOral_itemanotacaoentrevista($valor) {
		$this -> item_anotacaoEntrevista_idOral_itemanotacaoentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idOral_itemanotacaoentrevista() {
		return ($this -> idOral_itemanotacaoentrevista);
	}
	
	function get_oral_idOral_itemanotacaoentrevista() {
		return ($this -> oral_idOral_itemanotacaoentrevista);
	}
	
	function get_item_anotacaoEntrevista_idOral_itemanotacaoentrevista() {
		return ($this -> item_anotacaoEntrevista_idOral_itemanotacaoentrevista);
	}
				
	//MANUSEANDO O BANCO
		
	function insertOral_itemanotacaoentrevista() {
		$sql = "INSERT INTO oral_itemanotacaoentrevista 
		(oral_id, item_anotacaoEntrevista_id) 
		VALUES (	
			" . $this -> oral_idOral_itemanotacaoentrevista . ", 	
			" . $this -> item_anotacaoEntrevista_idOral_itemanotacaoentrevista . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteOral_itemanotacaoentrevista() {
		return $this -> updateCampoOral_itemanotacaoentrevista(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateOral_itemanotacaoentrevista() {
		if( $this -> idOral_itemanotacaoentrevista ){
				
			return $this -> updateCampoOral_itemanotacaoentrevista(
				array(		
					"oral_id" => $this -> oral_idOral_itemanotacaoentrevista, 		
					"item_anotacaoEntrevista_id" => $this -> item_anotacaoEntrevista_idOral_itemanotacaoentrevista				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoOral_itemanotacaoentrevista($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idOral_itemanotacaoentrevista && is_array($sets) ){
			$sql = "UPDATE oral_itemanotacaoentrevista SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idOral_itemanotacaoentrevista;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectOral_itemanotacaoentrevista($where = "", $campos = array("O.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM oral_itemanotacaoentrevista AS O ".$where;
		return $this -> executarQuery($sql);
	}
		
}
