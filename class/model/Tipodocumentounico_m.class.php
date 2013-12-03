<?php
class Tipodocumentounico_m extends Database { 
	
	// ATRIBUTOS
	protected $idTipodocumentounico;
	protected $nomeTipodocumentounico;
	protected $classTipodocumentounico;
	
	//CONSTRUTOR
	function __construct( $idTipodocumentounico = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTipodocumentounico) ){
		
			$array = $this -> selectTipodocumentounico(" WHERE T.id = ".$this -> gravarBD($idTipodocumentounico) );			
			
			$this -> idTipodocumentounico = $array[0]['id'];
			$this -> nomeTipodocumentounico = $array[0]['nome'];
			$this -> classTipodocumentounico = $array[0]['class'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTipodocumentounico($valor) {
		$this -> idTipodocumentounico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeTipodocumentounico($valor) {
		$this -> nomeTipodocumentounico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_classTipodocumentounico($valor) {
		$this -> classTipodocumentounico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idTipodocumentounico() {
		return ($this -> idTipodocumentounico);
	}
	
	function get_nomeTipodocumentounico() {
		return ($this -> nomeTipodocumentounico);
	}
	
	function get_classTipodocumentounico() {
		return ($this -> classTipodocumentounico);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTipodocumentounico() {
		$sql = "INSERT INTO tipodocumentounico (nome, class) 
		VALUES ($this -> nomeTipodocumentounico, $this -> classTipodocumentounico)";
		if( $this -> query($sql) ){
			return mysql_insert_id($this -> connect, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTipodocumentounico() {
		
	if( $this -> idTipodocumentounico ){
		$sql = "DELETE FROM tipodocumentounico WHERE id = ".$this -> idTipodocumentounico;			
		return $this -> query($sql, MSG_CADDEL);
	}else{
		return array(false, MSG_ERR);
	}
	
	}

	function updateTipodocumentounico() {
		if( $this -> idTipodocumentounico ){
				
			return $this -> updateCampoTipodocumentounico(
				array(		
					"nome" => $this -> nomeTipodocumentounico, 		
					"class" => $this -> classTipodocumentounico				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTipodocumentounico($sets = array(), $msg) {		
		if( $this -> idTipodocumentounico && is_array($sets) ){
			$sql = "UPDATE tipodocumentounico SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTipodocumentounico;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTipodocumentounico($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM tipodocumentounico AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
