<?php
class Resp_alternativacorreta_m extends Database { 
	
	// ATRIBUTOS
	protected $idResp_alternativacorreta;
	protected $pergunta_idResp_alternativacorreta;
	protected $corretaResp_alternativacorreta = 0;
	protected $ordemResp_alternativacorreta;
	protected $respostaResp_alternativacorreta;
	
	//CONSTRUTOR
	function __construct( $idResp_alternativacorreta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResp_alternativacorreta) ){
		
			$array = $this -> selectResp_alternativacorreta(" WHERE R.id = ".$this -> gravarBD($idResp_alternativacorreta) );			
			
			$this -> idResp_alternativacorreta = $array[0]['id'];
			$this -> pergunta_idResp_alternativacorreta = $array[0]['pergunta_id'];
			$this -> corretaResp_alternativacorreta = $array[0]['correta'];
			$this -> ordemResp_alternativacorreta = $array[0]['ordem'];
			$this -> respostaResp_alternativacorreta = $array[0]['resposta'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResp_alternativacorreta($valor) {
		$this -> idResp_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idResp_alternativacorreta($valor) {
		$this -> pergunta_idResp_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_corretaResp_alternativacorreta($valor) {
		$this -> corretaResp_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_ordemResp_alternativacorreta($valor) {
		$this -> ordemResp_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_respostaResp_alternativacorreta($valor) {
		$this -> respostaResp_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResp_alternativacorreta() {
		return ($this -> idResp_alternativacorreta);
	}
	
	function get_pergunta_idResp_alternativacorreta() {
		return ($this -> pergunta_idResp_alternativacorreta);
	}
	
	function get_corretaResp_alternativacorreta($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> corretaResp_alternativacorreta : Uteis::exibirStatus($this -> corretaResp_alternativacorreta);
	}
	
	function get_ordemResp_alternativacorreta() {
		return ($this -> ordemResp_alternativacorreta);
	}
	
	function get_respostaResp_alternativacorreta() {
		return ($this -> respostaResp_alternativacorreta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResp_alternativacorreta() {
		$sql = "INSERT INTO resp_alternativacorreta 
		(pergunta_id, correta, ordem, resposta) 
		VALUES (	
			" . $this -> pergunta_idResp_alternativacorreta . ", 	
			" . $this -> corretaResp_alternativacorreta . ", 	
			" . $this -> ordemResp_alternativacorreta . ", 	
			" . $this -> respostaResp_alternativacorreta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResp_alternativacorreta() {
		return $this -> updateCampoResp_alternativacorreta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResp_alternativacorreta() {
		if( $this -> idResp_alternativacorreta ){
				
			return $this -> updateCampoResp_alternativacorreta(
				array(		
					"pergunta_id" => $this -> pergunta_idResp_alternativacorreta, 		
					"correta" => $this -> corretaResp_alternativacorreta, 		
					"ordem" => $this -> ordemResp_alternativacorreta, 		
					"resposta" => $this -> respostaResp_alternativacorreta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResp_alternativacorreta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResp_alternativacorreta && is_array($sets) ){
			$sql = "UPDATE resp_alternativacorreta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResp_alternativacorreta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResp_alternativacorreta($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resp_alternativacorreta AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
