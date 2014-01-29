<?php
class Idioma_m extends Database { 
	
	// ATRIBUTOS
	protected $idIdioma;
	protected $nomeIdioma;
	
	//CONSTRUTOR
	function __construct( $idIdioma = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idIdioma) ){
		
			$array = $this -> selectIdioma(" WHERE I.id = ".$this -> gravarBD($idIdioma) );			
			
			$this -> idIdioma = $array[0]['id'];
			$this -> nomeIdioma = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idIdioma($valor) {
		$this -> idIdioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeIdioma($valor) {
		$this -> nomeIdioma = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idIdioma() {
		return ($this -> idIdioma);
	}
	
	function get_nomeIdioma() {
		return ($this -> nomeIdioma);
	}
				
	//MANUSEANDO O BANCO
		
	function insertIdioma() {
		$sql = "INSERT INTO idioma 
		(nome) 
		VALUES (	
			" . $this -> nomeIdioma . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteIdioma() {
		return $this -> updateCampoIdioma(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateIdioma() {
		if( $this -> idIdioma ){
				
			return $this -> updateCampoIdioma(
				array(		
					"nome" => $this -> nomeIdioma				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoIdioma($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idIdioma && is_array($sets) ){
			$sql = "UPDATE idioma SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idIdioma;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectIdioma($where = "", $campos = array("I.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM idioma AS I ".$where;
		return $this -> executarQuery($sql);
	}
		
}
