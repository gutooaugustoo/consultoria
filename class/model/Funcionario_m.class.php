<?php
class Funcionario_m extends Database { 
	
	// ATRIBUTOS
	protected $idFuncionario;
	
	//CONSTRUTOR
	function __construct( $idFuncionario = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idFuncionario) ){
		
			$array = $this -> selectFuncionario(" WHERE id = ".$this -> gravarBD($idFuncionario) );			
			
			$this -> idFuncionario = $array[0]['id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idFuncionario($valor) {
		$this -> idFuncionario = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idFuncionario() {
		return ($this -> idFuncionario);
	}
				
	//MANUSEANDO O BANCO
		
	function insertFuncionario() {
		$sql = "INSERT INTO funcionario () 
		VALUES ()";
		if( $this -> query($sql) ){
			return mysql_insert_id($this -> connect, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteFuncionario() {
		
	if( $this -> idFuncionario ){
		$sql = "DELETE FROM funcionario WHERE id = ".$this -> idFuncionario;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updateFuncionario() {
		if( $this -> idFuncionario ){
				
			return $this -> updateCampoFuncionario(
				array(				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoFuncionario($sets = array(), $msg) {		
		if( $this -> idFuncionario && is_array($sets) ){
			$sql = "UPDATE funcionario SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idFuncionario;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectFuncionario($where = "", $campos = array("F.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM funcionario AS F ".$where;
		return $this -> executarQuery($sql);
	}
		
}
