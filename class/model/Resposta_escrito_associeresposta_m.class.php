<?php
class Resposta_escrito_associeresposta_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escrito_associeresposta;
	protected $candidato_escrito_idResposta_escrito_associeresposta;
	protected $escrito_pergunta_idResposta_escrito_associeresposta;
	protected $resp_associeResposta_idResposta_escrito_associeresposta;
	protected $ordemResposta_escrito_associeresposta = 0;
	
	//CONSTRUTOR
	function __construct( $idResposta_escrito_associeresposta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escrito_associeresposta) ){		
			$array = $this -> selectResposta_escrito_associeresposta(" WHERE R.id = ".$this -> gravarBD($idResposta_escrito_associeresposta) );						
    }elseif( $idResposta_escrito_associeresposta != "" ){
      $array = $this -> selectResposta_escrito_associeresposta($idResposta_escrito_associeresposta." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escrito_associeresposta = $array[0]['id'];
			$this -> candidato_escrito_idResposta_escrito_associeresposta = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idResposta_escrito_associeresposta = $array[0]['escrito_pergunta_id'];
			$this -> resp_associeResposta_idResposta_escrito_associeresposta = $array[0]['resp_associeResposta_id'];
			$this -> ordemResposta_escrito_associeresposta = $array[0]['ordem'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escrito_associeresposta($valor) {
		$this -> idResposta_escrito_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idResposta_escrito_associeresposta($valor) {
		$this -> candidato_escrito_idResposta_escrito_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idResposta_escrito_associeresposta($valor) {
		$this -> escrito_pergunta_idResposta_escrito_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_associeResposta_idResposta_escrito_associeresposta($valor) {
		$this -> resp_associeResposta_idResposta_escrito_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ordemResposta_escrito_associeresposta($valor) {
		$this -> ordemResposta_escrito_associeresposta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escrito_associeresposta() {
		return ($this -> idResposta_escrito_associeresposta);
	}
	
	function get_candidato_escrito_idResposta_escrito_associeresposta() {
		return ($this -> candidato_escrito_idResposta_escrito_associeresposta);
	}
	
	function get_escrito_pergunta_idResposta_escrito_associeresposta() {
		return ($this -> escrito_pergunta_idResposta_escrito_associeresposta);
	}
	
	function get_resp_associeResposta_idResposta_escrito_associeresposta() {
		return ($this -> resp_associeResposta_idResposta_escrito_associeresposta);
	}
	
	function get_ordemResposta_escrito_associeresposta() {
		return ($this -> ordemResposta_escrito_associeresposta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escrito_associeresposta() {
		$sql = "INSERT INTO resposta_escrito_associeresposta 
		(candidato_escrito_id, escrito_pergunta_id, resp_associeResposta_id, ordem) 
		VALUES (	
			" . $this -> candidato_escrito_idResposta_escrito_associeresposta . ", 	
			" . $this -> escrito_pergunta_idResposta_escrito_associeresposta . ", 	
			" . $this -> resp_associeResposta_idResposta_escrito_associeresposta . ", 	
			" . $this -> ordemResposta_escrito_associeresposta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escrito_associeresposta() {
		return $this -> updateCampoResposta_escrito_associeresposta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escrito_associeresposta() {
		if( $this -> idResposta_escrito_associeresposta ){
				
			return $this -> updateCampoResposta_escrito_associeresposta(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idResposta_escrito_associeresposta, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idResposta_escrito_associeresposta, 		
					"resp_associeResposta_id" => $this -> resp_associeResposta_idResposta_escrito_associeresposta, 		
					"ordem" => $this -> ordemResposta_escrito_associeresposta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escrito_associeresposta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escrito_associeresposta && is_array($sets) ){
			$sql = "UPDATE resposta_escrito_associeresposta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escrito_associeresposta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escrito_associeresposta($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escrito_associeresposta AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
