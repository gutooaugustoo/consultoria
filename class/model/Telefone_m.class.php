<?php
class Telefone_m extends Database { 
	
	// ATRIBUTOS
	protected $idTelefone;
	protected $pessoa_idTelefone;
	protected $empresa_idTelefone;
	protected $descricaoTelefone_idTelefone;
	protected $dddTelefone;
	protected $numeroTelefone;
	
	//CONSTRUTOR
	function __construct( $idTelefone = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTelefone) ){
		
			$array = $this -> selectTelefone(" WHERE T.id = ".$this -> gravarBD($idTelefone) );			
			
			$this -> idTelefone = $array[0]['id'];
			$this -> pessoa_idTelefone = $array[0]['pessoa_id'];
			$this -> empresa_idTelefone = $array[0]['empresa_id'];
			$this -> descricaoTelefone_idTelefone = $array[0]['descricaoTelefone_id'];
			$this -> dddTelefone = $array[0]['ddd'];
			$this -> numeroTelefone = $array[0]['numero'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTelefone($valor) {
		$this -> idTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pessoa_idTelefone($valor) {
		$this -> pessoa_idTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idTelefone($valor) {
		$this -> empresa_idTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descricaoTelefone_idTelefone($valor) {
		$this -> descricaoTelefone_idTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dddTelefone($valor) {
		$this -> dddTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_numeroTelefone($valor) {
		$this -> numeroTelefone = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idTelefone() {
		return ($this -> idTelefone);
	}
	
	function get_pessoa_idTelefone() {
		return ($this -> pessoa_idTelefone);
	}
	
	function get_empresa_idTelefone() {
		return ($this -> empresa_idTelefone);
	}
	
	function get_descricaoTelefone_idTelefone() {
		return ($this -> descricaoTelefone_idTelefone);
	}
	
	function get_dddTelefone() {
		return ($this -> dddTelefone);
	}
	
	function get_numeroTelefone() {
		return ($this -> numeroTelefone);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTelefone() {
		$sql = "INSERT INTO telefone 
		(pessoa_id, empresa_id, descricaoTelefone_id, ddd, numero) 
		VALUES (	
			" . $this -> pessoa_idTelefone . ", 	
			" . $this -> empresa_idTelefone . ", 	
			" . $this -> descricaoTelefone_idTelefone . ", 	
			" . $this -> dddTelefone . ", 	
			" . $this -> numeroTelefone . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTelefone() {
		return $this -> updateCampoTelefone(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateTelefone() {
		if( $this -> idTelefone ){
				
			return $this -> updateCampoTelefone(
				array(		
					"pessoa_id" => $this -> pessoa_idTelefone, 		
					"empresa_id" => $this -> empresa_idTelefone, 		
					"descricaoTelefone_id" => $this -> descricaoTelefone_idTelefone, 		
					"ddd" => $this -> dddTelefone, 		
					"numero" => $this -> numeroTelefone				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTelefone($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTelefone && is_array($sets) ){
			$sql = "UPDATE telefone SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTelefone;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTelefone($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM telefone AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
