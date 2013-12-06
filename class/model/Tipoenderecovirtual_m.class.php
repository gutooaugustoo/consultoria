<?php
class Tipoenderecovirtual_m extends Database { 
	
	// ATRIBUTOS
	protected $idTipoenderecovirtual;
	protected $nomeTipoenderecovirtual;
	
	//CONSTRUTOR
	function __construct( $idTipoenderecovirtual = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTipoenderecovirtual) ){
		
			$array = $this -> selectTipoenderecovirtual(" WHERE T.id = ".$this -> gravarBD($idTipoenderecovirtual) );			
			
			$this -> idTipoenderecovirtual = $array[0]['id'];
			$this -> nomeTipoenderecovirtual = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTipoenderecovirtual($valor) {
		$this -> idTipoenderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeTipoenderecovirtual($valor) {
		$this -> nomeTipoenderecovirtual = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idTipoenderecovirtual() {
		return ($this -> idTipoenderecovirtual);
	}
	
	function get_nomeTipoenderecovirtual() {
		return ($this -> nomeTipoenderecovirtual);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTipoenderecovirtual() {
		$sql = "INSERT INTO tipoenderecovirtual 
		(nome) 
		VALUES (	
			" . $this -> nomeTipoenderecovirtual . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTipoenderecovirtual() {
		return $this -> updateCampoTipoenderecovirtual(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateTipoenderecovirtual() {
		if( $this -> idTipoenderecovirtual ){
				
			return $this -> updateCampoTipoenderecovirtual(
				array(		
					"nome" => $this -> nomeTipoenderecovirtual				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTipoenderecovirtual($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTipoenderecovirtual && is_array($sets) ){
			$sql = "UPDATE tipoenderecovirtual SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTipoenderecovirtual;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTipoenderecovirtual($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM tipoenderecovirtual AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
