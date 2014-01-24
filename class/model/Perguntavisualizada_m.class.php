<?php
class Perguntavisualizada_m extends Database { 
	
	// ATRIBUTOS
	protected $idPerguntavisualizada;
	protected $candidato_escrito_idPerguntavisualizada;
	protected $escrito_pergunta_idPerguntavisualizada;
	
	//CONSTRUTOR
	function __construct( $idPerguntavisualizada = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPerguntavisualizada) ){		
			$array = $this -> selectPerguntavisualizada(" WHERE P.id = ".$this -> gravarBD($idPerguntavisualizada) );						
    }elseif( $idPerguntavisualizada != "" ){
      $array = $this -> selectPerguntavisualizada($idPerguntavisualizada." LIMIT 1");
    }
    
    if( $array ){
			$this -> idPerguntavisualizada = $array[0]['id'];
			$this -> candidato_escrito_idPerguntavisualizada = $array[0]['candidato_escrito_id'];
			$this -> escrito_pergunta_idPerguntavisualizada = $array[0]['escrito_pergunta_id'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPerguntavisualizada($valor) {
		$this -> idPerguntavisualizada = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_escrito_idPerguntavisualizada($valor) {
		$this -> candidato_escrito_idPerguntavisualizada = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_pergunta_idPerguntavisualizada($valor) {
		$this -> escrito_pergunta_idPerguntavisualizada = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idPerguntavisualizada() {
		return ($this -> idPerguntavisualizada);
	}
	
	function get_candidato_escrito_idPerguntavisualizada() {
		return ($this -> candidato_escrito_idPerguntavisualizada);
	}
	
	function get_escrito_pergunta_idPerguntavisualizada() {
		return ($this -> escrito_pergunta_idPerguntavisualizada);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPerguntavisualizada() {
		$sql = "INSERT INTO perguntavisualizada 
		(candidato_escrito_id, escrito_pergunta_id) 
		VALUES (	
			" . $this -> candidato_escrito_idPerguntavisualizada . ", 	
			" . $this -> escrito_pergunta_idPerguntavisualizada . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePerguntavisualizada() {
		return $this -> updateCampoPerguntavisualizada(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePerguntavisualizada() {
		if( $this -> idPerguntavisualizada ){
				
			return $this -> updateCampoPerguntavisualizada(
				array(		
					"candidato_escrito_id" => $this -> candidato_escrito_idPerguntavisualizada, 		
					"escrito_pergunta_id" => $this -> escrito_pergunta_idPerguntavisualizada				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPerguntavisualizada($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPerguntavisualizada && is_array($sets) ){
			$sql = "UPDATE perguntavisualizada SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPerguntavisualizada;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPerguntavisualizada($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM perguntavisualizada AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
