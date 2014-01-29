<?php
class Uf_m extends Database { 
	
	// ATRIBUTOS
	protected $idUf;
	protected $siglaUf;
	protected $nomeUf;
	
	//CONSTRUTOR
	function __construct( $idUf = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idUf) ){
		
			$array = $this -> selectUf(" WHERE U.id = ".$this -> gravarBD($idUf) );			
			
			$this -> idUf = $array[0]['id'];
			$this -> siglaUf = $array[0]['sigla'];
			$this -> nomeUf = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idUf($valor) {
		$this -> idUf = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_siglaUf($valor) {
		$this -> siglaUf = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeUf($valor) {
		$this -> nomeUf = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idUf() {
		return ($this -> idUf);
	}
	
	function get_siglaUf() {
		return ($this -> siglaUf);
	}
	
	function get_nomeUf() {
		return ($this -> nomeUf);
	}
				
	//MANUSEANDO O BANCO
		
	function insertUf() {
		$sql = "INSERT INTO uf 
		(sigla, nome) 
		VALUES (	
			" . $this -> siglaUf . ", 	
			" . $this -> nomeUf . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteUf() {
		
	if( $this -> idUf ){
		$sql = "DELETE FROM uf WHERE id = ".$this -> idUf;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updateUf() {
		if( $this -> idUf ){
				
			return $this -> updateCampoUf(
				array(		
					"sigla" => $this -> siglaUf, 		
					"nome" => $this -> nomeUf				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoUf($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idUf && is_array($sets) ){
			$sql = "UPDATE uf SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idUf;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectUf($where = "", $campos = array("U.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM uf AS U ".$where;
		return $this -> executarQuery($sql);
	}
		
}
