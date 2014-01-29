<?php
class Resp_verdadeirofalso_m extends Database { 
	
	// ATRIBUTOS
	protected $idResp_verdadeirofalso;
	protected $pergunta_idResp_verdadeirofalso;
	protected $ordemResp_verdadeirofalso;
	protected $verdadeiroFalsoResp_verdadeirofalso = 0;
	protected $respostaResp_verdadeirofalso;
	
	//CONSTRUTOR
	function __construct( $idResp_verdadeirofalso = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResp_verdadeirofalso) ){
		
			$array = $this -> selectResp_verdadeirofalso(" WHERE R.id = ".$this -> gravarBD($idResp_verdadeirofalso) );			
			
			$this -> idResp_verdadeirofalso = $array[0]['id'];
			$this -> pergunta_idResp_verdadeirofalso = $array[0]['pergunta_id'];
			$this -> ordemResp_verdadeirofalso = $array[0]['ordem'];
			$this -> verdadeiroFalsoResp_verdadeirofalso = $array[0]['verdadeiroFalso'];
			$this -> respostaResp_verdadeirofalso = $array[0]['resposta'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResp_verdadeirofalso($valor) {
		$this -> idResp_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idResp_verdadeirofalso($valor) {
		$this -> pergunta_idResp_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ordemResp_verdadeirofalso($valor) {
		$this -> ordemResp_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_verdadeiroFalsoResp_verdadeirofalso($valor) {
		$this -> verdadeiroFalsoResp_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_respostaResp_verdadeirofalso($valor) {
		$this -> respostaResp_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResp_verdadeirofalso() {
		return ($this -> idResp_verdadeirofalso);
	}
	
	function get_pergunta_idResp_verdadeirofalso() {
		return ($this -> pergunta_idResp_verdadeirofalso);
	}
	
	function get_ordemResp_verdadeirofalso() {
		return ($this -> ordemResp_verdadeirofalso);
	}
	
	function get_verdadeiroFalsoResp_verdadeirofalso($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> verdadeiroFalsoResp_verdadeirofalso : Uteis::exibirStatus($this -> verdadeiroFalsoResp_verdadeirofalso);
	}
	
	function get_respostaResp_verdadeirofalso() {
		return ($this -> respostaResp_verdadeirofalso);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResp_verdadeirofalso() {
		$sql = "INSERT INTO resp_verdadeirofalso 
		(pergunta_id, ordem, verdadeiroFalso, resposta) 
		VALUES (	
			" . $this -> pergunta_idResp_verdadeirofalso . ", 	
			" . $this -> ordemResp_verdadeirofalso . ", 	
			" . $this -> verdadeiroFalsoResp_verdadeirofalso . ", 	
			" . $this -> respostaResp_verdadeirofalso . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResp_verdadeirofalso() {
		return $this -> updateCampoResp_verdadeirofalso(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResp_verdadeirofalso() {
		if( $this -> idResp_verdadeirofalso ){
				
			return $this -> updateCampoResp_verdadeirofalso(
				array(		
					"pergunta_id" => $this -> pergunta_idResp_verdadeirofalso, 		
					"ordem" => $this -> ordemResp_verdadeirofalso, 		
					"verdadeiroFalso" => $this -> verdadeiroFalsoResp_verdadeirofalso, 		
					"resposta" => $this -> respostaResp_verdadeirofalso				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResp_verdadeirofalso($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResp_verdadeirofalso && is_array($sets) ){
			$sql = "UPDATE resp_verdadeirofalso SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResp_verdadeirofalso;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResp_verdadeirofalso($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resp_verdadeirofalso AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
