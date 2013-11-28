<?php
class Modelo_m extends Database { 
	
	// ATRIBUTOS
	protected $id;
	protected $campoString;
	protected $campoText;
	protected $campoInt;
	protected $campoBool = 0;
	protected $campoDate;
	protected $campoDouble;
	
	//CONSTRUTOR
	function __construct( $id = "" ) {
		
		parent::__construct();
		
		if( $id != "" ){
		
			$array = $this->select(" WHERE id = ".$this->gravarBD($id) );			
			
			$this->id = $array[0]['id'];
			$this->campoString = $array[0]['campoString'];
			$this->campoText = $array[0]['campoText'];
			$this->campoInt = $array[0]['campoInt'];
			$this->campoBool = $array[0]['campoBool'];
			$this->campoDate = $array[0]['campoDate'];
			$this->campoDouble = $array[0]['campoDouble'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_id($valor) {
		$this->id = ($valor) ? $this->gravarBD($valor) : "NULL";
	}
	
	function set_campoString($valor) {
		$this->campoString = ($valor) ? $this->gravarBD($valor) : "NULL";
	}
	
	function set_campoText($valor) {
		$this->campoText = ($valor) ? $this->gravarBD($valor) : "NULL";
	}
	
	function set_campoInt($valor) {
		$this->campoInt = ($valor) ? $this->gravarBD($valor) : "NULL";
	}
	
	function set_campoBool($valor) {
		$this->campoBool = ($valor) ? $this->gravarBD($valor) : "0";
	}
	
	function set_campoDate($valor) {
		$this->campoDate = ($valor) ? $this->gravarBD(Uteis::gravarData($valor)) : "NULL";
	}
	
	function set_campoDouble($valor) {
		$this->campoDouble = ($valor) ? $this->gravarBD(Uteis::gravarMoeda($valor)) : "0";
	}
	
	
	//GETS
	
	function get_id() {
		return ($this->id);
	}
	
	function get_campoString() {
		return ($this->campoString);
	}
	
	function get_campoText() {
		return ($this->campoText);
	}
	
	function get_campoInt() {
		return ($this->campoInt);
	}
	
	function get_campoBool($mostrarImagem = false) {
		return !$mostrarImagem ? $this->campoBool : Uteis::exibirStatus($this->campoBool);
	}
	
	function get_campoDate() {
		if( $this->campoDate ) return Uteis::exibirData($this->campoDate);
	}
	
	function get_campoDouble($formatarMoeda = false) {
		return !$formatarMoeda ? Uteis::exibirMoeda($this->campoDouble) : "R$ ".Uteis::formatarMoeda($this->campoDouble);
	}
	
			
	//INTERAÇÃO COM O BANCO
		
	function insert() {
		$sql = "INSERT INTO modelo (campoString, campoText, campoInt, campoBool, campoDate, campoDouble) 
		VALUES ($this->campoString, $this->campoText, $this->campoInt, $this->campoBool, $this->campoDate, $this->campoDouble)";
		$result = $this->query($sql);
		return mysql_insert_id($this->connect);
	}
	
	function delete() {
		if( $this->id ){
			$sql = "UPDATE modelo SET excluido = 1 WHERE id = ".$this->id;
			$this->query($sql);
		}
	}

	function update() {
		if( $this->id ){
			$sql = "UPDATE modelo
			SET campoString = $this->campoString, campoText = $this->campoText, campoInt = $this->campoInt, campoBool = $this->campoBool, campoDate = $this->campoDate, campoDouble = $this->campoDouble
			WHERE id = $this->id";
			$this->query($sql);
		}
	}
	
	function updateCampo($campo, $valor) {		
		if( $this->id ){
			$sql = "UPDATE modelo SET $campo = ".$this->gravarBD($valor)." WHERE id = $this->id";
			$this->query($sql);
		}
	}

	function select($where = "", $campos = array("*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM modelo ".$where;
		return $this->executarQuery($sql);
	}
		
}
