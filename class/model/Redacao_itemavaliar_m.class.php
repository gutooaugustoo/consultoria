<?php
class Redacao_itemavaliar_m extends Database { 
	
	// ATRIBUTOS
	protected $idRedacao_itemavaliar;
	protected $itemAvaliarRedacao_idRedacao_itemavaliar;
	protected $redacao_idRedacao_itemavaliar;
	protected $obsTemRedacao_itemavaliar = 0;
	protected $obsObrigatorioRedacao_itemavaliar;
	
	//CONSTRUTOR
	function __construct( $idRedacao_itemavaliar = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idRedacao_itemavaliar) ){
		
			$array = $this -> selectRedacao_itemavaliar(" WHERE R.id = ".$this -> gravarBD($idRedacao_itemavaliar) );			
			
			$this -> idRedacao_itemavaliar = $array[0]['id'];
			$this -> itemAvaliarRedacao_idRedacao_itemavaliar = $array[0]['itemAvaliarRedacao_id'];
			$this -> redacao_idRedacao_itemavaliar = $array[0]['redacao_id'];
			$this -> obsTemRedacao_itemavaliar = $array[0]['obsTem'];
			$this -> obsObrigatorioRedacao_itemavaliar = $array[0]['obsObrigatorio'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idRedacao_itemavaliar($valor) {
		$this -> idRedacao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_itemAvaliarRedacao_idRedacao_itemavaliar($valor) {
		$this -> itemAvaliarRedacao_idRedacao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_redacao_idRedacao_itemavaliar($valor) {
		$this -> redacao_idRedacao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_obsTemRedacao_itemavaliar($valor) {
		$this -> obsTemRedacao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_obsObrigatorioRedacao_itemavaliar($valor) {
		$this -> obsObrigatorioRedacao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idRedacao_itemavaliar() {
		return ($this -> idRedacao_itemavaliar);
	}
	
	function get_itemAvaliarRedacao_idRedacao_itemavaliar() {
		return ($this -> itemAvaliarRedacao_idRedacao_itemavaliar);
	}
	
	function get_redacao_idRedacao_itemavaliar() {
		return ($this -> redacao_idRedacao_itemavaliar);
	}
	
	function get_obsTemRedacao_itemavaliar($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> obsTemRedacao_itemavaliar : Uteis::exibirStatus($this -> obsTemRedacao_itemavaliar);
	}
	
	function get_obsObrigatorioRedacao_itemavaliar($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> obsObrigatorioRedacao_itemavaliar : Uteis::exibirStatus($this -> obsObrigatorioRedacao_itemavaliar);
	}
				
	//MANUSEANDO O BANCO
		
	function insertRedacao_itemavaliar() {
		$sql = "INSERT INTO redacao_itemavaliar 
		(itemAvaliarRedacao_id, redacao_id, obsTem, obsObrigatorio) 
		VALUES (	
			" . $this -> itemAvaliarRedacao_idRedacao_itemavaliar . ", 	
			" . $this -> redacao_idRedacao_itemavaliar . ", 	
			" . $this -> obsTemRedacao_itemavaliar . ", 	
			" . $this -> obsObrigatorioRedacao_itemavaliar . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteRedacao_itemavaliar() {
		return $this -> updateCampoRedacao_itemavaliar(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateRedacao_itemavaliar() {
		if( $this -> idRedacao_itemavaliar ){
				
			return $this -> updateCampoRedacao_itemavaliar(
				array(		
					"itemAvaliarRedacao_id" => $this -> itemAvaliarRedacao_idRedacao_itemavaliar, 		
					"redacao_id" => $this -> redacao_idRedacao_itemavaliar, 		
					"obsTem" => $this -> obsTemRedacao_itemavaliar, 		
					"obsObrigatorio" => $this -> obsObrigatorioRedacao_itemavaliar				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoRedacao_itemavaliar($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idRedacao_itemavaliar && is_array($sets) ){
			$sql = "UPDATE redacao_itemavaliar SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idRedacao_itemavaliar;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectRedacao_itemavaliar($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM redacao_itemavaliar AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
