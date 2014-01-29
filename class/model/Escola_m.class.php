<?php
class Escola_m extends Database { 
	
	// ATRIBUTOS
	protected $idEscola;
	protected $nomeEscola;
	
	//CONSTRUTOR
	function __construct( $idEscola = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEscola) ){
		
			$array = $this -> selectEscola(" WHERE E.id = ".$this -> gravarBD($idEscola) );			
			
			$this -> idEscola = $array[0]['id'];
			$this -> nomeEscola = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEscola($valor) {
		$this -> idEscola = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeEscola($valor) {
		$this -> nomeEscola = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEscola() {
		return ($this -> idEscola);
	}
	
	function get_nomeEscola() {
		return ($this -> nomeEscola);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEscola() {
		$sql = "INSERT INTO escola 
		(nome) 
		VALUES (	
			" . $this -> nomeEscola . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEscola() {
		return $this -> updateCampoEscola(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEscola() {
		if( $this -> idEscola ){
				
			return $this -> updateCampoEscola(
				array(		
					"nome" => $this -> nomeEscola				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEscola($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEscola && is_array($sets) ){
			$sql = "UPDATE escola SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEscola;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEscola($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM escola AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
