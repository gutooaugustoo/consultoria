<?php
class Dicasentrevista_m extends Database { 
	
	// ATRIBUTOS
	protected $idDicasentrevista;
	protected $idioma_idDicasentrevista;
	protected $tituloDicasentrevista;
	protected $inativoDicasentrevista = 0;
	protected $dicaDicasentrevista;
	
	//CONSTRUTOR
	function __construct( $idDicasentrevista = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idDicasentrevista) ){
		
			$array = $this -> selectDicasentrevista(" WHERE D.id = ".$this -> gravarBD($idDicasentrevista) );			
			
			$this -> idDicasentrevista = $array[0]['id'];
			$this -> idioma_idDicasentrevista = $array[0]['idioma_id'];
			$this -> tituloDicasentrevista = $array[0]['titulo'];
			$this -> inativoDicasentrevista = $array[0]['inativo'];
			$this -> dicaDicasentrevista = $array[0]['dica'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idDicasentrevista($valor) {
		$this -> idDicasentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idDicasentrevista($valor) {
		$this -> idioma_idDicasentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tituloDicasentrevista($valor) {
		$this -> tituloDicasentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoDicasentrevista($valor) {
		$this -> inativoDicasentrevista = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_dicaDicasentrevista($valor) {
		$this -> dicaDicasentrevista = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idDicasentrevista() {
		return ($this -> idDicasentrevista);
	}
	
	function get_idioma_idDicasentrevista() {
		return ($this -> idioma_idDicasentrevista);
	}
	
	function get_tituloDicasentrevista() {
		return ($this -> tituloDicasentrevista);
	}
	
	function get_inativoDicasentrevista($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoDicasentrevista : Uteis::exibirStatus(!$this -> inativoDicasentrevista);
	}
	
	function get_dicaDicasentrevista() {
		return ($this -> dicaDicasentrevista);
	}
				
	//MANUSEANDO O BANCO
		
	function insertDicasentrevista() {
		$sql = "INSERT INTO dicasentrevista 
		(idioma_id, titulo, inativo, dica) 
		VALUES (	
			" . $this -> idioma_idDicasentrevista . ", 	
			" . $this -> tituloDicasentrevista . ", 	
			" . $this -> inativoDicasentrevista . ", 	
			" . $this -> dicaDicasentrevista . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteDicasentrevista() {
		return $this -> updateCampoDicasentrevista(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateDicasentrevista() {
		if( $this -> idDicasentrevista ){
				
			return $this -> updateCampoDicasentrevista(
				array(		
					"idioma_id" => $this -> idioma_idDicasentrevista, 		
					"titulo" => $this -> tituloDicasentrevista, 		
					"inativo" => $this -> inativoDicasentrevista, 		
					"dica" => $this -> dicaDicasentrevista				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoDicasentrevista($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idDicasentrevista && is_array($sets) ){
			$sql = "UPDATE dicasentrevista SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idDicasentrevista;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectDicasentrevista($where = "", $campos = array("D.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM dicasentrevista AS D ".$where;
		return $this -> executarQuery($sql);
	}
		
}
