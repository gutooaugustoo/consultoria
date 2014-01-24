<?php
class Resposta_escrito_alternativacorreta_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escrito_alternativacorreta;
	protected $candidato_escrito_idResposta_escrito_alternativacorreta;
	protected $escrito_pergunta_idResposta_escrito_alternativacorreta;
	protected $resp_alternativacorreta_idResposta_escrito_alternativacorreta;
	
	//CONSTRUTOR
	function __construct( $idResposta_escrito_alternativacorreta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escrito_alternativacorreta) ){		
			$array = $this -> selectResposta_escrito_alternativacorreta(" WHERE R.id = ".$this -> gravarBD($idResposta_escrito_alternativacorreta) );						
    }elseif( $idResposta_escrito_alternativacorreta != "" ){
      $array = $this -> selectResposta_escrito_alternativacorreta($idResposta_escrito_alternativacorreta." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escrito_alternativacorreta = $array[0]['id'];
			$this -> candidato_escrito_idResposta_escrito_alternativacorreta = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idResposta_escrito_alternativacorreta = $array[0]['escrito_pergunta_id'];
			$this -> resp_alternativacorreta_idResposta_escrito_alternativacorreta = $array[0]['resp_alternativacorreta_id'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escrito_alternativacorreta($valor) {
		$this -> idResposta_escrito_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idResposta_escrito_alternativacorreta($valor) {
		$this -> candidato_escrito_idResposta_escrito_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idResposta_escrito_alternativacorreta($valor) {
		$this -> escrito_pergunta_idResposta_escrito_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_alternativacorreta_idResposta_escrito_alternativacorreta($valor) {
		$this -> resp_alternativacorreta_idResposta_escrito_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escrito_alternativacorreta() {
		return ($this -> idResposta_escrito_alternativacorreta);
	}
	
	function get_candidato_escrito_idResposta_escrito_alternativacorreta() {
		return ($this -> candidato_escrito_idResposta_escrito_alternativacorreta);
	}
	
	function get_escrito_pergunta_idResposta_escrito_alternativacorreta() {
		return ($this -> escrito_pergunta_idResposta_escrito_alternativacorreta);
	}
	
	function get_resp_alternativacorreta_idResposta_escrito_alternativacorreta() {
		return ($this -> resp_alternativacorreta_idResposta_escrito_alternativacorreta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escrito_alternativacorreta() {
		$sql = "INSERT INTO resposta_escrito_alternativacorreta 
		(candidato_escrito_id, escrito_pergunta_id, resp_alternativacorreta_id) 
		VALUES (	
			" . $this -> candidato_escrito_idResposta_escrito_alternativacorreta . ", 	
			" . $this -> escrito_pergunta_idResposta_escrito_alternativacorreta . ", 	
			" . $this -> resp_alternativacorreta_idResposta_escrito_alternativacorreta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escrito_alternativacorreta() {
		return $this -> updateCampoResposta_escrito_alternativacorreta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escrito_alternativacorreta() {
		if( $this -> idResposta_escrito_alternativacorreta ){
				
			return $this -> updateCampoResposta_escrito_alternativacorreta(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idResposta_escrito_alternativacorreta, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idResposta_escrito_alternativacorreta, 		
					"resp_alternativacorreta_id" => $this -> resp_alternativacorreta_idResposta_escrito_alternativacorreta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escrito_alternativacorreta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escrito_alternativacorreta && is_array($sets) ){
			$sql = "UPDATE resposta_escrito_alternativacorreta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escrito_alternativacorreta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escrito_alternativacorreta($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escrito_alternativacorreta AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
