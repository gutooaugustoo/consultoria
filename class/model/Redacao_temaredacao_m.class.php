<?php
class Redacao_temaredacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idRedacao_temaredacao;
	protected $redacao_idRedacao_temaredacao;
	protected $temaRedacao_idRedacao_temaredacao;
	
	//CONSTRUTOR
	function __construct( $idRedacao_temaredacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idRedacao_temaredacao) ){
		
			$array = $this -> selectRedacao_temaredacao(" WHERE R.id = ".$this -> gravarBD($idRedacao_temaredacao) );			
			
			$this -> idRedacao_temaredacao = $array[0]['id'];
			$this -> redacao_idRedacao_temaredacao = $array[0]['redacao_id'];
			$this -> temaRedacao_idRedacao_temaredacao = $array[0]['temaRedacao_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idRedacao_temaredacao($valor) {
		$this -> idRedacao_temaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_redacao_idRedacao_temaredacao($valor) {
		$this -> redacao_idRedacao_temaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_temaRedacao_idRedacao_temaredacao($valor) {
		$this -> temaRedacao_idRedacao_temaredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idRedacao_temaredacao() {
		return ($this -> idRedacao_temaredacao);
	}
	
	function get_redacao_idRedacao_temaredacao() {
		return ($this -> redacao_idRedacao_temaredacao);
	}
	
	function get_temaRedacao_idRedacao_temaredacao() {
		return ($this -> temaRedacao_idRedacao_temaredacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertRedacao_temaredacao() {
		$sql = "INSERT INTO redacao_temaredacao 
		(redacao_id, temaRedacao_id) 
		VALUES (	
			" . $this -> redacao_idRedacao_temaredacao . ", 	
			" . $this -> temaRedacao_idRedacao_temaredacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteRedacao_temaredacao() {
		return $this -> updateCampoRedacao_temaredacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateRedacao_temaredacao() {
		if( $this -> idRedacao_temaredacao ){
				
			return $this -> updateCampoRedacao_temaredacao(
				array(		
					"redacao_id" => $this -> redacao_idRedacao_temaredacao, 		
					"temaRedacao_id" => $this -> temaRedacao_idRedacao_temaredacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoRedacao_temaredacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idRedacao_temaredacao && is_array($sets) ){
			$sql = "UPDATE redacao_temaredacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idRedacao_temaredacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectRedacao_temaredacao($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM redacao_temaredacao AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
