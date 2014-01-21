<?php
class Teste_m extends Database { 
	
	// ATRIBUTOS
	protected $idTeste;
	protected $campoStringTeste;
	protected $campoTextTeste;
	protected $campoIntTeste;
	protected $campoBoolTeste = 0;
	protected $campoDateTeste;
	protected $campoDoubleTeste;
	
	//CONSTRUTOR
	function __construct( $idTeste = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idTeste) ){
		
			$array = $this -> selectTeste(" WHERE T.id = ".$this -> gravarBD($idTeste) );			
			
			$this -> idTeste = $array[0]['id'];
			$this -> campoStringTeste = $array[0]['campoString'];
			$this -> campoTextTeste = $array[0]['campoText'];
			$this -> campoIntTeste = $array[0]['campoInt'];
			$this -> campoBoolTeste = $array[0]['campoBool'];
			$this -> campoDateTeste = $array[0]['campoDate'];
			$this -> campoDoubleTeste = $array[0]['campoDouble'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTeste($valor) {
		$this -> idTeste = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoStringTeste($valor) {
		$this -> campoStringTeste = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoTextTeste($valor) {
		$this -> campoTextTeste = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoIntTeste($valor) {
		$this -> campoIntTeste = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoBoolTeste($valor) {
		$this -> campoBoolTeste = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_campoDateTeste($valor) {
		$this -> campoDateTeste = ($valor) ? $this -> gravarBD(Uteis::gravarData($valor)) : "NULL";
		return $this;
	}
	
	function set_campoDoubleTeste($valor) {
		$this -> campoDoubleTeste = ($valor) ? $this -> gravarBD(Uteis::gravarMoeda($valor)) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idTeste() {
		return ($this -> idTeste);
	}
	
	function get_campoStringTeste() {
		return ($this -> campoStringTeste);
	}
	
	function get_campoTextTeste() {
		return ($this -> campoTextTeste);
	}
	
	function get_campoIntTeste() {
		return ($this -> campoIntTeste);
	}
	
	function get_campoBoolTeste($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> campoBoolTeste : Uteis::exibirStatus($this -> campoBoolTeste);
	}
	
	function get_campoDateTeste() {
		if( $this -> campoDateTeste ) return Uteis::exibirData($this -> campoDateTeste);
	}
	
	function get_campoDoubleTeste($formatarMoeda = false) {
		return !$formatarMoeda ? Uteis::exibirMoeda($this -> campoDoubleTeste) : "R$ ".Uteis::formatarMoeda($this -> campoDoubleTeste);
	}
				
	//MANUSEANDO O BANCO
		
	function insertTeste() {
		$sql = "INSERT INTO teste 
		(campoString, campoText, campoInt, campoBool, campoDate, campoDouble) 
		VALUES (	
			" . $this -> campoStringTeste . ", 	
			" . $this -> campoTextTeste . ", 	
			" . $this -> campoIntTeste . ", 	
			" . $this -> campoBoolTeste . ", 	
			" . $this -> campoDateTeste . ", 	
			" . $this -> campoDoubleTeste . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteTeste() {
		return $this -> updateCampoTeste(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateTeste() {
		if( $this -> idTeste ){
				
			return $this -> updateCampoTeste(
				array(		
					"campoString" => $this -> campoStringTeste, 		
					"campoText" => $this -> campoTextTeste, 		
					"campoInt" => $this -> campoIntTeste, 		
					"campoBool" => $this -> campoBoolTeste, 		
					"campoDate" => $this -> campoDateTeste, 		
					"campoDouble" => $this -> campoDoubleTeste				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoTeste($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idTeste && is_array($sets) ){
			$sql = "UPDATE teste SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idTeste;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectTeste($where = "", $campos = array("T.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM teste AS T ".$where;
		return $this -> executarQuery($sql);
	}
		
}
