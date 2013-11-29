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
		
			$array = $this->selectTeste(" WHERE id = ".$this->gravarBD($idTeste) );			
			
			$this->idTeste = $array[0]['id'];
			$this->campoStringTeste = $array[0]['campoString'];
			$this->campoTextTeste = $array[0]['campoText'];
			$this->campoIntTeste = $array[0]['campoInt'];
			$this->campoBoolTeste = $array[0]['campoBool'];
			$this->campoDateTeste = $array[0]['campoDate'];
			$this->campoDoubleTeste = $array[0]['campoDouble'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idTeste($valor) {
		$this->idTeste = ($valor) ? $this->gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoStringTeste($valor) {
		$this->campoStringTeste = ($valor) ? $this->gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoTextTeste($valor) {
		$this->campoTextTeste = ($valor) ? $this->gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoIntTeste($valor) {
		$this->campoIntTeste = ($valor) ? $this->gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_campoBoolTeste($valor) {
		$this->campoBoolTeste = ($valor) ? $this->gravarBD($valor) : "0";
		return $this;
	}
	
	function set_campoDateTeste($valor) {
		$this->campoDateTeste = ($valor) ? $this->gravarBD(Uteis::gravarData($valor)) : "NULL";
		return $this;
	}
	
	function set_campoDoubleTeste($valor) {
		$this->campoDoubleTeste = ($valor) ? $this->gravarBD(Uteis::gravarMoeda($valor)) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idTeste() {
		return ($this->idTeste);
	}
	
	function get_campoStringTeste() {
		return ($this->campoStringTeste);
	}
	
	function get_campoTextTeste() {
		return ($this->campoTextTeste);
	}
	
	function get_campoIntTeste() {
		return ($this->campoIntTeste);
	}
	
	function get_campoBoolTeste($mostrarImagem = false) {
		return !$mostrarImagem ? $this->campoBoolTeste : Uteis::exibirStatus($this->campoBoolTeste);
	}
	
	function get_campoDateTeste() {
		if( $this->campoDateTeste ) return Uteis::exibirData($this->campoDateTeste);
	}
	
	function get_campoDoubleTeste($formatarMoeda = false) {
		return !$formatarMoeda ? Uteis::exibirMoeda($this->campoDoubleTeste) : "R$ ".Uteis::formatarMoeda($this->campoDoubleTeste);
	}
	
			
	//MANUSEANDO O BANCO
		
	function insertTeste() {
		$sql = "INSERT INTO teste (campoString, campoText, campoInt, campoBool, campoDate, campoDouble) 
		VALUES ($this->campoStringTeste, $this->campoTextTeste, $this->campoIntTeste, $this->campoBoolTeste, $this->campoDateTeste, $this->campoDoubleTeste)";
		$result = $this->query($sql);
		return mysql_insert_id($this->connect);
	}
	
	function deleteTeste() {
		if( $this->idTeste ){
			$sql = "UPDATE teste SET excluido = 1 WHERE id = ".$this->idTeste;
			//$sql = "DELETE FROM teste WHERE id = ".$this->idTeste;
			return $this->query($sql);
		}else{
			return false;
		}
	}

	function updateTeste() {
		if( $this->idTeste ){
			$sql = "UPDATE teste
			SET campoString = $this->campoStringTeste, campoText = $this->campoTextTeste, campoInt = $this->campoIntTeste, campoBool = $this->campoBoolTeste, campoDate = $this->campoDateTeste, campoDouble = $this->campoDoubleTeste
			WHERE id = $this->idTeste";
			return $this->query($sql);
		}else{
			return false;
		}
	}
	
	function updateCampoTeste($campo, $valor) {		
		if( $this->idTeste ){
			$sql = "UPDATE teste SET $campo = ".$this->gravarBD($valor)." WHERE id = $this->idTeste";
			return $this->query($sql);
		}else{
			return false;
		}
	}

	function selectTeste($where = "", $campos = array("*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM teste ".$where;
		return $this->executarQuery($sql);
	}
		
}
