<?php
class Item_anotacaoentrevista_m extends Database { 
	
	// ATRIBUTOS
	protected $idItem_anotacaoentrevista;
	protected $itemItem_anotacaoentrevista;
	
	//CONSTRUTOR
	function __construct( $idItem_anotacaoentrevista = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idItem_anotacaoentrevista) ){
		
			$array = $this -> selectItem_anotacaoentrevista(" WHERE I.id = ".$this -> gravarBD($idItem_anotacaoentrevista) );			
			
			$this -> idItem_anotacaoentrevista = $array[0]['id'];
			$this -> itemItem_anotacaoentrevista = $array[0]['item'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idItem_anotacaoentrevista($valor) {
		$this -> idItem_anotacaoentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_itemItem_anotacaoentrevista($valor) {
		$this -> itemItem_anotacaoentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idItem_anotacaoentrevista() {
		return ($this -> idItem_anotacaoentrevista);
	}
	
	function get_itemItem_anotacaoentrevista() {
		return ($this -> itemItem_anotacaoentrevista);
	}
				
	//MANUSEANDO O BANCO
		
	function insertItem_anotacaoentrevista() {
		$sql = "INSERT INTO item_anotacaoentrevista 
		(item) 
		VALUES (	
			" . $this -> itemItem_anotacaoentrevista . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteItem_anotacaoentrevista() {
		
		if( $this -> idItem_anotacaoentrevista ){
			$sql = "DELETE FROM item_anotacaoentrevista WHERE id = ".$this -> idItem_anotacaoentrevista;			
			return $this -> query($sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	
	}

	function updateItem_anotacaoentrevista() {
		if( $this -> idItem_anotacaoentrevista ){
				
			return $this -> updateCampoItem_anotacaoentrevista(
				array(		
					"item" => $this -> itemItem_anotacaoentrevista				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoItem_anotacaoentrevista($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idItem_anotacaoentrevista && is_array($sets) ){
			$sql = "UPDATE item_anotacaoentrevista SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idItem_anotacaoentrevista;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectItem_anotacaoentrevista($where = "", $campos = array("I.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM item_anotacaoentrevista AS I ".$where;
		return $this -> executarQuery($sql);
	}
		
}
