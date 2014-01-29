<?php
class Enderecovirtual_m extends Database { 
	
	// ATRIBUTOS
	protected $idEnderecovirtual;
	protected $empresa_idEnderecovirtual;
	protected $pessoa_idEnderecovirtual;
	protected $tipoEnderecoVirtual_idEnderecovirtual;
	protected $nomeEnderecovirtual;
	
	//CONSTRUTOR
	function __construct( $idEnderecovirtual = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEnderecovirtual) ){
		
			$array = $this -> selectEnderecovirtual(" WHERE E.id = ".$this -> gravarBD($idEnderecovirtual) );			
			
			$this -> idEnderecovirtual = $array[0]['id'];
			$this -> empresa_idEnderecovirtual = $array[0]['empresa_id'];
			$this -> pessoa_idEnderecovirtual = $array[0]['pessoa_id'];
			$this -> tipoEnderecoVirtual_idEnderecovirtual = $array[0]['tipoEnderecoVirtual_id'];
			$this -> nomeEnderecovirtual = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEnderecovirtual($valor) {
		$this -> idEnderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idEnderecovirtual($valor) {
		$this -> empresa_idEnderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pessoa_idEnderecovirtual($valor) {
		$this -> pessoa_idEnderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tipoEnderecoVirtual_idEnderecovirtual($valor) {
		$this -> tipoEnderecoVirtual_idEnderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeEnderecovirtual($valor) {
		$this -> nomeEnderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEnderecovirtual() {
		return ($this -> idEnderecovirtual);
	}
	
	function get_empresa_idEnderecovirtual() {
		return ($this -> empresa_idEnderecovirtual);
	}
	
	function get_pessoa_idEnderecovirtual() {
		return ($this -> pessoa_idEnderecovirtual);
	}
	
	function get_tipoEnderecoVirtual_idEnderecovirtual() {
		return ($this -> tipoEnderecoVirtual_idEnderecovirtual);
	}
	
	function get_nomeEnderecovirtual() {
		return ($this -> nomeEnderecovirtual);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEnderecovirtual() {
		$sql = "INSERT INTO enderecovirtual 
		(empresa_id, pessoa_id, tipoEnderecoVirtual_id, nome) 
		VALUES (	
			" . $this -> empresa_idEnderecovirtual . ", 	
			" . $this -> pessoa_idEnderecovirtual . ", 	
			" . $this -> tipoEnderecoVirtual_idEnderecovirtual . ", 	
			" . $this -> nomeEnderecovirtual . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEnderecovirtual() {
		return $this -> updateCampoEnderecovirtual(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEnderecovirtual() {
		if( $this -> idEnderecovirtual ){
				
			return $this -> updateCampoEnderecovirtual(
				array(		
					"empresa_id" => $this -> empresa_idEnderecovirtual, 		
					"pessoa_id" => $this -> pessoa_idEnderecovirtual, 		
					"tipoEnderecoVirtual_id" => $this -> tipoEnderecoVirtual_idEnderecovirtual, 		
					"nome" => $this -> nomeEnderecovirtual				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEnderecovirtual($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEnderecovirtual && is_array($sets) ){
			$sql = "UPDATE enderecovirtual SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEnderecovirtual;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEnderecovirtual($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM enderecovirtual AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
