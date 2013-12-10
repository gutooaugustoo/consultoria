<?php
class Resp_associeresposta_m extends Database { 
	
	// ATRIBUTOS
	protected $idResp_associeresposta;
	protected $pergunta_idResp_associeresposta;
	protected $ordemResp_associeresposta;
	protected $descPerguntaResp_associeresposta;
	protected $descRespostaResp_associeresposta;
	
	//CONSTRUTOR
	function __construct( $idResp_associeresposta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResp_associeresposta) ){
		
			$array = $this -> selectResp_associeresposta(" WHERE R.id = ".$this -> gravarBD($idResp_associeresposta) );			
			
			$this -> idResp_associeresposta = $array[0]['id'];
			$this -> pergunta_idResp_associeresposta = $array[0]['pergunta_id'];
			$this -> ordemResp_associeresposta = $array[0]['ordem'];
			$this -> descPerguntaResp_associeresposta = $array[0]['descPergunta'];
			$this -> descRespostaResp_associeresposta = $array[0]['descResposta'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResp_associeresposta($valor) {
		$this -> idResp_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idResp_associeresposta($valor) {
		$this -> pergunta_idResp_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ordemResp_associeresposta($valor) {
		$this -> ordemResp_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descPerguntaResp_associeresposta($valor) {
		$this -> descPerguntaResp_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descRespostaResp_associeresposta($valor) {
		$this -> descRespostaResp_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResp_associeresposta() {
		return ($this -> idResp_associeresposta);
	}
	
	function get_pergunta_idResp_associeresposta() {
		return ($this -> pergunta_idResp_associeresposta);
	}
	
	function get_ordemResp_associeresposta() {
		return ($this -> ordemResp_associeresposta);
	}
	
	function get_descPerguntaResp_associeresposta() {
		return ($this -> descPerguntaResp_associeresposta);
	}
	
	function get_descRespostaResp_associeresposta() {
		return ($this -> descRespostaResp_associeresposta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResp_associeresposta() {
		$sql = "INSERT INTO resp_associeresposta 
		(pergunta_id, ordem, descPergunta, descResposta) 
		VALUES (	
			" . $this -> pergunta_idResp_associeresposta . ", 	
			" . $this -> ordemResp_associeresposta . ", 	
			" . $this -> descPerguntaResp_associeresposta . ", 	
			" . $this -> descRespostaResp_associeresposta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResp_associeresposta() {
		return $this -> updateCampoResp_associeresposta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResp_associeresposta() {
		if( $this -> idResp_associeresposta ){
				
			return $this -> updateCampoResp_associeresposta(
				array(		
					"pergunta_id" => $this -> pergunta_idResp_associeresposta, 		
					"ordem" => $this -> ordemResp_associeresposta, 		
					"descPergunta" => $this -> descPerguntaResp_associeresposta, 		
					"descResposta" => $this -> descRespostaResp_associeresposta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResp_associeresposta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResp_associeresposta && is_array($sets) ){
			$sql = "UPDATE resp_associeresposta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResp_associeresposta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResp_associeresposta($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resp_associeresposta AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
