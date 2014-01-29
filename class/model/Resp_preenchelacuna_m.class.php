<?php
class Resp_preenchelacuna_m extends Database { 
	
	// ATRIBUTOS
	protected $idResp_preenchelacuna;
	protected $pergunta_idResp_preenchelacuna;
	protected $ordemResp_preenchelacuna;
	protected $lacunaResp_preenchelacuna;
	
	//CONSTRUTOR
	function __construct( $idResp_preenchelacuna = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResp_preenchelacuna) ){
		
			$array = $this -> selectResp_preenchelacuna(" WHERE R.id = ".$this -> gravarBD($idResp_preenchelacuna) );			
			
			$this -> idResp_preenchelacuna = $array[0]['id'];
			$this -> pergunta_idResp_preenchelacuna = $array[0]['pergunta_id'];
			$this -> ordemResp_preenchelacuna = $array[0]['ordem'];
			$this -> lacunaResp_preenchelacuna = $array[0]['lacuna'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResp_preenchelacuna($valor) {
		$this -> idResp_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idResp_preenchelacuna($valor) {
		$this -> pergunta_idResp_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ordemResp_preenchelacuna($valor) {
		$this -> ordemResp_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_lacunaResp_preenchelacuna($valor) {
		$this -> lacunaResp_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResp_preenchelacuna() {
		return ($this -> idResp_preenchelacuna);
	}
	
	function get_pergunta_idResp_preenchelacuna() {
		return ($this -> pergunta_idResp_preenchelacuna);
	}
	
	function get_ordemResp_preenchelacuna() {
		return ($this -> ordemResp_preenchelacuna);
	}
	
	function get_lacunaResp_preenchelacuna() {
		return ($this -> lacunaResp_preenchelacuna);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResp_preenchelacuna() {
		$sql = "INSERT INTO resp_preenchelacuna 
		(pergunta_id, ordem, lacuna) 
		VALUES (	
			" . $this -> pergunta_idResp_preenchelacuna . ", 	
			" . $this -> ordemResp_preenchelacuna . ", 	
			" . $this -> lacunaResp_preenchelacuna . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResp_preenchelacuna() {
		return $this -> updateCampoResp_preenchelacuna(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResp_preenchelacuna() {
		if( $this -> idResp_preenchelacuna ){
				
			return $this -> updateCampoResp_preenchelacuna(
				array(		
					"pergunta_id" => $this -> pergunta_idResp_preenchelacuna, 							 	
					"lacuna" => $this -> lacunaResp_preenchelacuna			
					//"ordem" => $this -> ordemResp_preenchelacuna,
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResp_preenchelacuna($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResp_preenchelacuna && is_array($sets) ){
			$sql = "UPDATE resp_preenchelacuna SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResp_preenchelacuna;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResp_preenchelacuna($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resp_preenchelacuna AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
