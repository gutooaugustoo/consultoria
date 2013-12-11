<?php
class Oral_m extends Database { 
	
	// ATRIBUTOS
	protected $idOral;
	protected $servico_idOral;
	protected $etapa_idOral;
	protected $videoOral = 0;
	protected $mostrarAnotacaoOral = 0;
	protected $temAreaAtencaoOral = 0;
	
	//CONSTRUTOR
	function __construct( $idOral = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idOral) ){
		
			$array = $this -> selectOral(" WHERE O.id = ".$this -> gravarBD($idOral) );			
			
			$this -> idOral = $array[0]['id'];
			$this -> servico_idOral = $array[0]['servico_id'];
			$this -> etapa_idOral = $array[0]['etapa_id'];
			$this -> videoOral = $array[0]['video'];
			$this -> mostrarAnotacaoOral = $array[0]['mostrarAnotacao'];
			$this -> temAreaAtencaoOral = $array[0]['temAreaAtencao'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idOral($valor) {
		$this -> idOral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idOral($valor) {
		$this -> servico_idOral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_etapa_idOral($valor) {
		$this -> etapa_idOral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_videoOral($valor) {
		$this -> videoOral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_mostrarAnotacaoOral($valor) {
		$this -> mostrarAnotacaoOral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_temAreaAtencaoOral($valor) {
		$this -> temAreaAtencaoOral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idOral() {
		return ($this -> idOral);
	}
	
	function get_servico_idOral() {
		return ($this -> servico_idOral);
	}
	
	function get_etapa_idOral() {
		return ($this -> etapa_idOral);
	}
	
	function get_videoOral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> videoOral : Uteis::exibirStatus($this -> videoOral);
	}
	
	function get_mostrarAnotacaoOral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> mostrarAnotacaoOral : Uteis::exibirStatus($this -> mostrarAnotacaoOral);
	}
	
	function get_temAreaAtencaoOral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temAreaAtencaoOral : Uteis::exibirStatus($this -> temAreaAtencaoOral);
	}
				
	//MANUSEANDO O BANCO
		
	function insertOral() {
		$sql = "INSERT INTO oral 
		(servico_id, etapa_id, video, mostrarAnotacao, temAreaAtencao) 
		VALUES (	
			" . $this -> servico_idOral . ", 	
			" . $this -> etapa_idOral . ", 	
			" . $this -> videoOral . ", 	
			" . $this -> mostrarAnotacaoOral . ", 	
			" . $this -> temAreaAtencaoOral . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteOral() {
		return $this -> updateCampoOral(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateOral() {
		if( $this -> idOral ){
				
			return $this -> updateCampoOral(
				array(		
					"servico_id" => $this -> servico_idOral, 		
					"etapa_id" => $this -> etapa_idOral, 		
					"video" => $this -> videoOral, 		
					"mostrarAnotacao" => $this -> mostrarAnotacaoOral, 		
					"temAreaAtencao" => $this -> temAreaAtencaoOral				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoOral($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idOral && is_array($sets) ){
			$sql = "UPDATE oral SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idOral;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectOral($where = "", $campos = array("O.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM oral AS O ".$where;
		return $this -> executarQuery($sql);
	}
		
}
