<?php
class Itemavaliaroral_m extends Database { 
	
	// ATRIBUTOS
	protected $idItemavaliaroral;
	protected $enunciadoItemavaliaroral;
	protected $dicaComoResponderItemavaliaroral;
	protected $padraoItemavaliaroral = 0;
	protected $inativoItemavaliaroral = 0;
	
	//CONSTRUTOR
	function __construct( $idItemavaliaroral = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idItemavaliaroral) ){
		
			$array = $this -> selectItemavaliaroral(" WHERE I.id = ".$this -> gravarBD($idItemavaliaroral) );			
			
			$this -> idItemavaliaroral = $array[0]['id'];
			$this -> enunciadoItemavaliaroral = $array[0]['enunciado'];
			$this -> dicaComoResponderItemavaliaroral = $array[0]['dicaComoResponder'];
			$this -> padraoItemavaliaroral = $array[0]['padrao'];
			$this -> inativoItemavaliaroral = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idItemavaliaroral($valor) {
		$this -> idItemavaliaroral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_enunciadoItemavaliaroral($valor) {
		$this -> enunciadoItemavaliaroral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dicaComoResponderItemavaliaroral($valor) {
		$this -> dicaComoResponderItemavaliaroral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_padraoItemavaliaroral($valor) {
		$this -> padraoItemavaliaroral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_inativoItemavaliaroral($valor) {
		$this -> inativoItemavaliaroral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idItemavaliaroral() {
		return ($this -> idItemavaliaroral);
	}
	
	function get_enunciadoItemavaliaroral() {
		return ($this -> enunciadoItemavaliaroral);
	}
	
	function get_dicaComoResponderItemavaliaroral() {
		return ($this -> dicaComoResponderItemavaliaroral);
	}
	
	function get_padraoItemavaliaroral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> padraoItemavaliaroral : Uteis::exibirStatus($this -> padraoItemavaliaroral);
	}
	
	function get_inativoItemavaliaroral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoItemavaliaroral : Uteis::exibirStatus(!$this -> inativoItemavaliaroral);
	}
				
	//MANUSEANDO O BANCO
		
	function insertItemavaliaroral() {
		$sql = "INSERT INTO itemavaliaroral 
		(enunciado, dicaComoResponder, padrao, inativo) 
		VALUES (	
			" . $this -> enunciadoItemavaliaroral . ", 	
			" . $this -> dicaComoResponderItemavaliaroral . ", 	
			" . $this -> padraoItemavaliaroral . ", 	
			" . $this -> inativoItemavaliaroral . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteItemavaliaroral() {
		return $this -> updateCampoItemavaliaroral(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateItemavaliaroral() {
		if( $this -> idItemavaliaroral ){
				
			return $this -> updateCampoItemavaliaroral(
				array(		
					"enunciado" => $this -> enunciadoItemavaliaroral, 		
					"dicaComoResponder" => $this -> dicaComoResponderItemavaliaroral, 		
					"padrao" => $this -> padraoItemavaliaroral, 		
					"inativo" => $this -> inativoItemavaliaroral				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoItemavaliaroral($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idItemavaliaroral && is_array($sets) ){
			$sql = "UPDATE itemavaliaroral SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idItemavaliaroral;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectItemavaliaroral($where = "", $campos = array("I.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM itemavaliaroral AS I ".$where;
		return $this -> executarQuery($sql);
	}
		
}
