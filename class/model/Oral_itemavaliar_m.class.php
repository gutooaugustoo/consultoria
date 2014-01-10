<?php
class Oral_itemavaliar_m extends Database { 
	
	// ATRIBUTOS
	protected $idOral_itemavaliar;
	protected $oral_idOral_itemavaliar;
	protected $itemAvaliarOral_idOral_itemavaliar;
	protected $obsTemOral_itemavaliar;
	protected $obsObrigatotiaOral_itemavaliar;
	
	//CONSTRUTOR
	function __construct( $idOral_itemavaliar = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idOral_itemavaliar) ){
		
			$array = $this -> selectOral_itemavaliar(" WHERE O.id = ".$this -> gravarBD($idOral_itemavaliar) );			
			
			$this -> idOral_itemavaliar = $array[0]['id'];
			$this -> oral_idOral_itemavaliar = $array[0]['oral_id'];
			$this -> itemAvaliarOral_idOral_itemavaliar = $array[0]['itemAvaliarOral_id'];
			$this -> obsTemOral_itemavaliar = $array[0]['obsTem'];
			$this -> obsObrigatotiaOral_itemavaliar = $array[0]['obsObrigatotia'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idOral_itemavaliar($valor) {
		$this -> idOral_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_oral_idOral_itemavaliar($valor) {
		$this -> oral_idOral_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_itemAvaliarOral_idOral_itemavaliar($valor) {
		$this -> itemAvaliarOral_idOral_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_obsTemOral_itemavaliar($valor) {
		$this -> obsTemOral_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_obsObrigatotiaOral_itemavaliar($valor) {
		$this -> obsObrigatotiaOral_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idOral_itemavaliar() {
		return ($this -> idOral_itemavaliar);
	}
	
	function get_oral_idOral_itemavaliar() {
		return ($this -> oral_idOral_itemavaliar);
	}
	
	function get_itemAvaliarOral_idOral_itemavaliar() {
		return ($this -> itemAvaliarOral_idOral_itemavaliar);
	}
	
	function get_obsTemOral_itemavaliar($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> obsTemOral_itemavaliar : Uteis::exibirStatus($this -> obsTemOral_itemavaliar);
	}
	
	function get_obsObrigatotiaOral_itemavaliar($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> obsObrigatotiaOral_itemavaliar : Uteis::exibirStatus($this -> obsObrigatotiaOral_itemavaliar);
	}
				
	//MANUSEANDO O BANCO
		
	function insertOral_itemavaliar() {
		$sql = "INSERT INTO oral_itemavaliar 
		(oral_id, itemAvaliarOral_id, obsTem, obsObrigatotia) 
		VALUES (	
			" . $this -> oral_idOral_itemavaliar . ", 	
			" . $this -> itemAvaliarOral_idOral_itemavaliar . ", 	
			" . $this -> obsTemOral_itemavaliar . ", 	
			" . $this -> obsObrigatotiaOral_itemavaliar . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteOral_itemavaliar() {
		return $this -> updateCampoOral_itemavaliar(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateOral_itemavaliar() {
		if( $this -> idOral_itemavaliar ){
				
			return $this -> updateCampoOral_itemavaliar(
				array(		
					"oral_id" => $this -> oral_idOral_itemavaliar, 		
					"itemAvaliarOral_id" => $this -> itemAvaliarOral_idOral_itemavaliar, 		
					"obsTem" => $this -> obsTemOral_itemavaliar, 		
					"obsObrigatotia" => $this -> obsObrigatotiaOral_itemavaliar				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoOral_itemavaliar($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idOral_itemavaliar && is_array($sets) ){
			$sql = "UPDATE oral_itemavaliar SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idOral_itemavaliar;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectOral_itemavaliar($where = "", $campos = array("O.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM oral_itemavaliar AS O ".$where;
		return $this -> executarQuery($sql);
	}
		
}
