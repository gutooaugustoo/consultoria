<?php
class Endereco_m extends Database { 
	
	// ATRIBUTOS
	protected $idEndereco;
	protected $pessoa_idEndereco;
	protected $empresa_idEndereco;
	protected $pais_idEndereco;
	protected $cidade_idEndereco;
	protected $bairroEndereco;
	protected $numeroEndereco;
	protected $cepEndereco;
	protected $complementoEndereco;
	protected $cidadeEstrangeiraEndereco;
	
	//CONSTRUTOR
	function __construct( $idEndereco = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEndereco) ){
		
			$array = $this -> selectEndereco(" WHERE E.id = ".$this -> gravarBD($idEndereco) );			
			
			$this -> idEndereco = $array[0]['id'];
			$this -> pessoa_idEndereco = $array[0]['pessoa_id'];
			$this -> empresa_idEndereco = $array[0]['empresa_id'];
			$this -> pais_idEndereco = $array[0]['pais_id'];
			$this -> cidade_idEndereco = $array[0]['cidade_id'];
			$this -> bairroEndereco = $array[0]['bairro'];
			$this -> numeroEndereco = $array[0]['numero'];
			$this -> cepEndereco = $array[0]['cep'];
			$this -> complementoEndereco = $array[0]['complemento'];
			$this -> cidadeEstrangeiraEndereco = $array[0]['cidadeEstrangeira'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEndereco($valor) {
		$this -> idEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pessoa_idEndereco($valor) {
		$this -> pessoa_idEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idEndereco($valor) {
		$this -> empresa_idEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pais_idEndereco($valor) {
		$this -> pais_idEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_cidade_idEndereco($valor) {
		$this -> cidade_idEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_bairroEndereco($valor) {
		$this -> bairroEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_numeroEndereco($valor) {
		$this -> numeroEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_cepEndereco($valor) {
		$this -> cepEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_complementoEndereco($valor) {
		$this -> complementoEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_cidadeEstrangeiraEndereco($valor) {
		$this -> cidadeEstrangeiraEndereco = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEndereco() {
		return ($this -> idEndereco);
	}
	
	function get_pessoa_idEndereco() {
		return ($this -> pessoa_idEndereco);
	}
	
	function get_empresa_idEndereco() {
		return ($this -> empresa_idEndereco);
	}
	
	function get_pais_idEndereco() {
		return ($this -> pais_idEndereco);
	}
	
	function get_cidade_idEndereco() {
		return ($this -> cidade_idEndereco);
	}
	
	function get_bairroEndereco() {
		return ($this -> bairroEndereco);
	}
	
	function get_numeroEndereco() {
		return ($this -> numeroEndereco);
	}
	
	function get_cepEndereco() {
		return ($this -> cepEndereco);
	}
	
	function get_complementoEndereco() {
		return ($this -> complementoEndereco);
	}
	
	function get_cidadeEstrangeiraEndereco() {
		return ($this -> cidadeEstrangeiraEndereco);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEndereco() {
		$sql = "INSERT INTO endereco 
		(pessoa_id, empresa_id, pais_id, cidade_id, bairro, numero, cep, complemento, cidadeEstrangeira) 
		VALUES (	
			" . $this -> pessoa_idEndereco . ", 	
			" . $this -> empresa_idEndereco . ", 	
			" . $this -> pais_idEndereco . ", 	
			" . $this -> cidade_idEndereco . ", 	
			" . $this -> bairroEndereco . ", 	
			" . $this -> numeroEndereco . ", 	
			" . $this -> cepEndereco . ", 	
			" . $this -> complementoEndereco . ", 	
			" . $this -> cidadeEstrangeiraEndereco . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEndereco() {
		return $this -> updateCampoEndereco(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEndereco() {
		if( $this -> idEndereco ){
				
			return $this -> updateCampoEndereco(
				array(		
					"pessoa_id" => $this -> pessoa_idEndereco, 		
					"empresa_id" => $this -> empresa_idEndereco, 		
					"pais_id" => $this -> pais_idEndereco, 		
					"cidade_id" => $this -> cidade_idEndereco, 		
					"bairro" => $this -> bairroEndereco, 		
					"numero" => $this -> numeroEndereco, 		
					"cep" => $this -> cepEndereco, 		
					"complemento" => $this -> complementoEndereco, 		
					"cidadeEstrangeira" => $this -> cidadeEstrangeiraEndereco				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEndereco($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEndereco && is_array($sets) ){
			$sql = "UPDATE endereco SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEndereco;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEndereco($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM endereco AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
