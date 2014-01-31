<?php
class Resposta_escrito_lacuna_m extends Database { 
	
	// ATRIBUTOS
	protected $idResposta_escrito_lacuna;
	protected $candidato_escrito_idResposta_escrito_lacuna;
	protected $escrito_pergunta_idResposta_escrito_lacuna;
	protected $resp_preenchelacuna_idResposta_escrito_lacuna;
	protected $lacunaResposta_escrito_lacuna;
	
	//CONSTRUTOR
	function __construct( $idResposta_escrito_lacuna = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idResposta_escrito_lacuna) ){		
			$array = $this -> selectResposta_escrito_lacuna(" WHERE R.id = ".$this -> gravarBD($idResposta_escrito_lacuna) );						
    }elseif( $idResposta_escrito_lacuna != "" ){
      $array = $this -> selectResposta_escrito_lacuna($idResposta_escrito_lacuna." LIMIT 1");
    }
    
    if( $array ){
			$this -> idResposta_escrito_lacuna = $array[0]['id'];
			$this -> candidato_escrito_idResposta_escrito_lacuna = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idResposta_escrito_lacuna = $array[0]['escrito_pergunta_id'];
			$this -> resp_preenchelacuna_idResposta_escrito_lacuna = $array[0]['resp_preenchelacuna_id'];
			$this -> lacunaResposta_escrito_lacuna = $array[0]['lacuna'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idResposta_escrito_lacuna($valor) {
		$this -> idResposta_escrito_lacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idResposta_escrito_lacuna($valor) {
		$this -> candidato_escrito_idResposta_escrito_lacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idResposta_escrito_lacuna($valor) {
		$this -> escrito_pergunta_idResposta_escrito_lacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_resp_preenchelacuna_idResposta_escrito_lacuna($valor) {
		$this -> resp_preenchelacuna_idResposta_escrito_lacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_lacunaResposta_escrito_lacuna($valor) {
		$this -> lacunaResposta_escrito_lacuna = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idResposta_escrito_lacuna() {
		return ($this -> idResposta_escrito_lacuna);
	}
	
	function get_candidato_escrito_idResposta_escrito_lacuna() {
		return ($this -> candidato_escrito_idResposta_escrito_lacuna);
	}
	
	function get_escrito_pergunta_idResposta_escrito_lacuna() {
		return ($this -> escrito_pergunta_idResposta_escrito_lacuna);
	}
	
	function get_resp_preenchelacuna_idResposta_escrito_lacuna() {
		return ($this -> resp_preenchelacuna_idResposta_escrito_lacuna);
	}
	
	function get_lacunaResposta_escrito_lacuna() {
		return ($this -> lacunaResposta_escrito_lacuna);
	}
				
	//MANUSEANDO O BANCO
		
	function insertResposta_escrito_lacuna() {
		$sql = "INSERT INTO resposta_escrito_lacuna 
		(candidato_escrito_id, escrito_pergunta_id, resp_preenchelacuna_id, lacuna) 
		VALUES (	
			" . $this -> candidato_escrito_idResposta_escrito_lacuna . ", 	
			" . $this -> escrito_pergunta_idResposta_escrito_lacuna . ", 	
			" . $this -> resp_preenchelacuna_idResposta_escrito_lacuna . ", 	
			" . $this -> lacunaResposta_escrito_lacuna . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteResposta_escrito_lacuna() {
		return $this -> updateCampoResposta_escrito_lacuna(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateResposta_escrito_lacuna() {
		if( $this -> idResposta_escrito_lacuna ){
				
			return $this -> updateCampoResposta_escrito_lacuna(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idResposta_escrito_lacuna, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idResposta_escrito_lacuna, 		
					"resp_preenchelacuna_id" => $this -> resp_preenchelacuna_idResposta_escrito_lacuna, 		
					"lacuna" => $this -> lacunaResposta_escrito_lacuna				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoResposta_escrito_lacuna($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idResposta_escrito_lacuna && is_array($sets) ){
			$sql = "UPDATE resposta_escrito_lacuna SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idResposta_escrito_lacuna;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectResposta_escrito_lacuna($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM resposta_escrito_lacuna AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
