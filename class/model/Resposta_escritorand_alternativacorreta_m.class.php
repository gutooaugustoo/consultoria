<?php
class Resposta_escritorand_alternativacorreta_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escritorand_alternativacorreta;
	protected $candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta;
	protected $resp_alternativacorreta_idResposta_escritorand_alternativacorreta;
	
	//CONSTRUTOR
	function __construct( $idResposta_escritorand_alternativacorreta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escritorand_alternativacorreta) ){		
			$array = $this -> selectResposta_escritorand_alternativacorreta(" WHERE R.id = ".$this -> gravarBD($idResposta_escritorand_alternativacorreta) );						
    }elseif( $idResposta_escritorand_alternativacorreta != "" ){
      $array = $this -> selectResposta_escritorand_alternativacorreta($idResposta_escritorand_alternativacorreta." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escritorand_alternativacorreta = $array[0]['id'];
			$this -> candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta = $array[0]['candidato_escrito_randomica_com_pergunta_id'];
			$this -> resp_alternativacorreta_idResposta_escritorand_alternativacorreta = $array[0]['resp_alternativacorreta_id'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escritorand_alternativacorreta($valor) {
		$this -> idResposta_escritorand_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta($valor) {
		$this -> candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_alternativacorreta_idResposta_escritorand_alternativacorreta($valor) {
		$this -> resp_alternativacorreta_idResposta_escritorand_alternativacorreta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escritorand_alternativacorreta() {
		return ($this -> idResposta_escritorand_alternativacorreta);
	}
	
	function get_candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta() {
		return ($this -> candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta);
	}
	
	function get_resp_alternativacorreta_idResposta_escritorand_alternativacorreta() {
		return ($this -> resp_alternativacorreta_idResposta_escritorand_alternativacorreta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escritorand_alternativacorreta() {
		$sql = "INSERT INTO resposta_escritorand_alternativacorreta 
		(candidato_escrito_randomica_com_pergunta_id, resp_alternativacorreta_id) 
		VALUES (	
			" . $this -> candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta . ", 	
			" . $this -> resp_alternativacorreta_idResposta_escritorand_alternativacorreta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escritorand_alternativacorreta() {
		return $this -> updateCampoResposta_escritorand_alternativacorreta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escritorand_alternativacorreta() {
		if( $this -> idResposta_escritorand_alternativacorreta ){
				
			return $this -> updateCampoResposta_escritorand_alternativacorreta(
				array(		
					"candidato_escrito_randomica_com_pergunta_id" => $this -> candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta, 		
					"resp_alternativacorreta_id" => $this -> resp_alternativacorreta_idResposta_escritorand_alternativacorreta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escritorand_alternativacorreta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escritorand_alternativacorreta && is_array($sets) ){
			$sql = "UPDATE resposta_escritorand_alternativacorreta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escritorand_alternativacorreta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escritorand_alternativacorreta($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escritorand_alternativacorreta AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
