<?php
class Resposta_escrito_preenchelacuna_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escrito_preenchelacuna;
	protected $candidato_escrito_idResposta_escrito_preenchelacuna;
	protected $escrito_pergunta_idResposta_escrito_preenchelacuna;
	protected $resp_preenchelacuna_idResposta_escrito_preenchelacuna;
	protected $lacunaResposta_escrito_preenchelacuna;
	
	//CONSTRUTOR
	function __construct( $idResposta_escrito_preenchelacuna = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escrito_preenchelacuna) ){		
			$array = $this -> selectResposta_escrito_preenchelacuna(" WHERE R.id = ".$this -> gravarBD($idResposta_escrito_preenchelacuna) );						
    }elseif( $idResposta_escrito_preenchelacuna != "" ){
      $array = $this -> selectResposta_escrito_preenchelacuna($idResposta_escrito_preenchelacuna." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escrito_preenchelacuna = $array[0]['id'];
			$this -> candidato_escrito_idResposta_escrito_preenchelacuna = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idResposta_escrito_preenchelacuna = $array[0]['escrito_pergunta_id'];
			$this -> resp_preenchelacuna_idResposta_escrito_preenchelacuna = $array[0]['resp_preenchelacuna_id'];
			$this -> lacunaResposta_escrito_preenchelacuna = $array[0]['lacuna'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escrito_preenchelacuna($valor) {
		$this -> idResposta_escrito_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idResposta_escrito_preenchelacuna($valor) {
		$this -> candidato_escrito_idResposta_escrito_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idResposta_escrito_preenchelacuna($valor) {
		$this -> escrito_pergunta_idResposta_escrito_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_preenchelacuna_idResposta_escrito_preenchelacuna($valor) {
		$this -> resp_preenchelacuna_idResposta_escrito_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_lacunaResposta_escrito_preenchelacuna($valor) {
		$this -> lacunaResposta_escrito_preenchelacuna = ($valor) ? $this -> gravarBD($valor) : "''";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escrito_preenchelacuna() {
		return ($this -> idResposta_escrito_preenchelacuna);
	}
	
	function get_candidato_escrito_idResposta_escrito_preenchelacuna() {
		return ($this -> candidato_escrito_idResposta_escrito_preenchelacuna);
	}
	
	function get_escrito_pergunta_idResposta_escrito_preenchelacuna() {
		return ($this -> escrito_pergunta_idResposta_escrito_preenchelacuna);
	}
	
	function get_resp_preenchelacuna_idResposta_escrito_preenchelacuna() {
		return ($this -> resp_preenchelacuna_idResposta_escrito_preenchelacuna);
	}
	
	function get_lacunaResposta_escrito_preenchelacuna() {
		return ($this -> lacunaResposta_escrito_preenchelacuna);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escrito_preenchelacuna() {
		$sql = "INSERT INTO resposta_escrito_preenchelacuna 
		(candidato_escrito_id, escrito_pergunta_id, resp_preenchelacuna_id, lacuna) 
		VALUES (	
			" . $this -> candidato_escrito_idResposta_escrito_preenchelacuna . ", 	
			" . $this -> escrito_pergunta_idResposta_escrito_preenchelacuna . ", 	
			" . $this -> resp_preenchelacuna_idResposta_escrito_preenchelacuna . ", 	
			" . $this -> lacunaResposta_escrito_preenchelacuna . "
		)";   
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escrito_preenchelacuna() {
		return $this -> updateCampoResposta_escrito_preenchelacuna(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escrito_preenchelacuna() {
		if( $this -> idResposta_escrito_preenchelacuna ){
				
			return $this -> updateCampoResposta_escrito_preenchelacuna(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idResposta_escrito_preenchelacuna, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idResposta_escrito_preenchelacuna, 		
					"resp_preenchelacuna_id" => $this -> resp_preenchelacuna_idResposta_escrito_preenchelacuna, 		
					"lacuna" => $this -> lacunaResposta_escrito_preenchelacuna				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escrito_preenchelacuna($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escrito_preenchelacuna && is_array($sets) ){
			$sql = "UPDATE resposta_escrito_preenchelacuna SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escrito_preenchelacuna;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escrito_preenchelacuna($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escrito_preenchelacuna AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
