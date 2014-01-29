<?php
class Tipoescrito_m extends Database { 
	
	// ATRIBUTOS
	protected $idTipoescrito;
	protected $nomeTipoescrito;
	protected $inativoTipoescrito = 0;
	
	//CONSTRUTOR
	function __construct( $idTipoescrito = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTipoescrito) ){
		
			$array = $this -> selectTipoescrito(" WHERE T.id = ".$this -> gravarBD($idTipoescrito) );			
			
			$this -> idTipoescrito = $array[0]['id'];
			$this -> nomeTipoescrito = $array[0]['nome'];
			$this -> inativoTipoescrito = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTipoescrito($valor) {
		$this -> idTipoescrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeTipoescrito($valor) {
		$this -> nomeTipoescrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoTipoescrito($valor) {
		$this -> inativoTipoescrito = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idTipoescrito() {
		return ($this -> idTipoescrito);
	}
	
	function get_nomeTipoescrito() {
		return ($this -> nomeTipoescrito);
	}
	
	function get_inativoTipoescrito($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoTipoescrito : Uteis::exibirStatus(!$this -> inativoTipoescrito);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTipoescrito() {
		$sql = "INSERT INTO tipoescrito 
		(nome, inativo) 
		VALUES (	
			" . $this -> nomeTipoescrito . ", 	
			" . $this -> inativoTipoescrito . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTipoescrito() {
		return $this -> updateCampoTipoescrito(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateTipoescrito() {
		if( $this -> idTipoescrito ){
				
			return $this -> updateCampoTipoescrito(
				array(		
					"nome" => $this -> nomeTipoescrito, 		
					"inativo" => $this -> inativoTipoescrito				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTipoescrito($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTipoescrito && is_array($sets) ){
			$sql = "UPDATE tipoescrito SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTipoescrito;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTipoescrito($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM tipoescrito AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
