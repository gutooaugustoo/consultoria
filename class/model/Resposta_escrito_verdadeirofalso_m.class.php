<?php
class Resposta_escrito_verdadeirofalso_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escrito_verdadeirofalso;
	protected $candidato_escrito_idResposta_escrito_verdadeirofalso;
	protected $escrito_pergunta_idResposta_escrito_verdadeirofalso;
	protected $resp_verdadeirofalso_idResposta_escrito_verdadeirofalso;
	protected $verdadeiroFalsoResposta_escrito_verdadeirofalso = 0;
	
	//CONSTRUTOR
	function __construct( $idResposta_escrito_verdadeirofalso = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escrito_verdadeirofalso) ){		
			$array = $this -> selectResposta_escrito_verdadeirofalso(" WHERE R.id = ".$this -> gravarBD($idResposta_escrito_verdadeirofalso) );						
    }elseif( $idResposta_escrito_verdadeirofalso != "" ){
      $array = $this -> selectResposta_escrito_verdadeirofalso($idResposta_escrito_verdadeirofalso." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escrito_verdadeirofalso = $array[0]['id'];
			$this -> candidato_escrito_idResposta_escrito_verdadeirofalso = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idResposta_escrito_verdadeirofalso = $array[0]['escrito_pergunta_id'];
			$this -> resp_verdadeirofalso_idResposta_escrito_verdadeirofalso = $array[0]['resp_verdadeirofalso_id'];
			$this -> verdadeiroFalsoResposta_escrito_verdadeirofalso = $array[0]['verdadeiroFalso'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escrito_verdadeirofalso($valor) {
		$this -> idResposta_escrito_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idResposta_escrito_verdadeirofalso($valor) {
		$this -> candidato_escrito_idResposta_escrito_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idResposta_escrito_verdadeirofalso($valor) {
		$this -> escrito_pergunta_idResposta_escrito_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_verdadeirofalso_idResposta_escrito_verdadeirofalso($valor) {
		$this -> resp_verdadeirofalso_idResposta_escrito_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_verdadeiroFalsoResposta_escrito_verdadeirofalso($valor) {
		$this -> verdadeiroFalsoResposta_escrito_verdadeirofalso = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escrito_verdadeirofalso() {
		return ($this -> idResposta_escrito_verdadeirofalso);
	}
	
	function get_candidato_escrito_idResposta_escrito_verdadeirofalso() {
		return ($this -> candidato_escrito_idResposta_escrito_verdadeirofalso);
	}
	
	function get_escrito_pergunta_idResposta_escrito_verdadeirofalso() {
		return ($this -> escrito_pergunta_idResposta_escrito_verdadeirofalso);
	}
	
	function get_resp_verdadeirofalso_idResposta_escrito_verdadeirofalso() {
		return ($this -> resp_verdadeirofalso_idResposta_escrito_verdadeirofalso);
	}
	
	function get_verdadeiroFalsoResposta_escrito_verdadeirofalso($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> verdadeiroFalsoResposta_escrito_verdadeirofalso : Uteis::exibirStatus($this -> verdadeiroFalsoResposta_escrito_verdadeirofalso);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escrito_verdadeirofalso() {
		$sql = "INSERT INTO resposta_escrito_verdadeirofalso 
		(candidato_escrito_id, escrito_pergunta_id, resp_verdadeirofalso_id, verdadeiroFalso) 
		VALUES (	
			" . $this -> candidato_escrito_idResposta_escrito_verdadeirofalso . ", 	
			" . $this -> escrito_pergunta_idResposta_escrito_verdadeirofalso . ", 	
			" . $this -> resp_verdadeirofalso_idResposta_escrito_verdadeirofalso . ", 	
			" . $this -> verdadeiroFalsoResposta_escrito_verdadeirofalso . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escrito_verdadeirofalso() {
		return $this -> updateCampoResposta_escrito_verdadeirofalso(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escrito_verdadeirofalso() {
		if( $this -> idResposta_escrito_verdadeirofalso ){
				
			return $this -> updateCampoResposta_escrito_verdadeirofalso(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idResposta_escrito_verdadeirofalso, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idResposta_escrito_verdadeirofalso, 		
					"resp_verdadeirofalso_id" => $this -> resp_verdadeirofalso_idResposta_escrito_verdadeirofalso, 		
					"verdadeiroFalso" => $this -> verdadeiroFalsoResposta_escrito_verdadeirofalso				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escrito_verdadeirofalso($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escrito_verdadeirofalso && is_array($sets) ){
			$sql = "UPDATE resposta_escrito_verdadeirofalso SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escrito_verdadeirofalso;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escrito_verdadeirofalso($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escrito_verdadeirofalso AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
