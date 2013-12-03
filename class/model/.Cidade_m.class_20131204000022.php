<?php
class Cidade_m extends Database { 
	
	// ATRIBUTOS
	protected $idCidade;
	protected $uf_idCidade;
	protected $nomeCidade;
	
	//CONSTRUTOR
	function __construct( $idCidade = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCidade) ){
		
			$array = $this -> selectCidade(" WHERE C.id = ".$this -> gravarBD($idCidade) );			
			
			$this -> idCidade = $array[0]['id'];
			$this -> uf_idCidade = $array[0]['uf_id'];
			$this -> nomeCidade = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCidade($valor) {
		$this -> idCidade = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_uf_idCidade($valor) {
		$this -> uf_idCidade = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeCidade($valor) {
		$this -> nomeCidade = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idCidade() {
		return ($this -> idCidade);
	}
	
	function get_uf_idCidade() {
		return ($this -> uf_idCidade);
	}
	
	function get_nomeCidade() {
		return ($this -> nomeCidade);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCidade() {
		$sql = "INSERT INTO cidade 
		(uf_id, nome) 
		VALUES (	
			" . $this -> uf_idCidade . ", 	
			" . $this -> nomeCidade . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCidade() {
		
	if( $this -> idCidade ){
		$sql = "DELETE FROM cidade WHERE id = ".$this -> idCidade;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updateCidade() {
		if( $this -> idCidade ){
				
			return $this -> updateCampoCidade(
				array(		
					"uf_id" => $this -> uf_idCidade, 		
					"nome" => $this -> nomeCidade				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCidade($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCidade && is_array($sets) ){
			$sql = "UPDATE cidade SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCidade;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCidade($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM cidade AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
