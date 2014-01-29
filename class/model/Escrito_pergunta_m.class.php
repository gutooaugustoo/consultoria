<?php
class Escrito_pergunta_m extends Database { 
	
	// ATRIBUTOS
	protected $idEscrito_pergunta;
	protected $escrito_idEscrito_pergunta;
	protected $pergunta_idEscrito_pergunta;
	protected $ordemEscrito_pergunta;
	
	//CONSTRUTOR
	function __construct( $idEscrito_pergunta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEscrito_pergunta) ){		
			$array = $this -> selectEscrito_pergunta(" WHERE E.id = ".$this -> gravarBD($idEscrito_pergunta) );			
		}elseif( $idEscrito_pergunta != "" ){
      $array = $this -> selectEscrito_pergunta($idEscrito_pergunta." LIMIT 1");
    }
    
    if( $array ){	
			$this -> idEscrito_pergunta = $array[0]['id'];
			$this -> escrito_idEscrito_pergunta = $array[0]['escrito_id'];
			$this -> pergunta_idEscrito_pergunta = $array[0]['pergunta_id'];
			$this -> ordemEscrito_pergunta = $array[0]['ordem'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEscrito_pergunta($valor) {
		$this -> idEscrito_pergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_idEscrito_pergunta($valor) {
		$this -> escrito_idEscrito_pergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idEscrito_pergunta($valor) {
		$this -> pergunta_idEscrito_pergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ordemEscrito_pergunta($valor) {
		$this -> ordemEscrito_pergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idEscrito_pergunta() {
		return ($this -> idEscrito_pergunta);
	}
	
	function get_escrito_idEscrito_pergunta() {
		return ($this -> escrito_idEscrito_pergunta);
	}
	
	function get_pergunta_idEscrito_pergunta() {
		return ($this -> pergunta_idEscrito_pergunta);
	}
	
	function get_ordemEscrito_pergunta() {
		return ($this -> ordemEscrito_pergunta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEscrito_pergunta() {
		$sql = "INSERT INTO escrito_pergunta 
		(escrito_id, pergunta_id, ordem) 
		VALUES (	
			" . $this -> escrito_idEscrito_pergunta . ", 	
			" . $this -> pergunta_idEscrito_pergunta . ", 	
			" . $this -> ordemEscrito_pergunta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEscrito_pergunta() {
		return $this -> updateCampoEscrito_pergunta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEscrito_pergunta() {
		if( $this -> idEscrito_pergunta ){
				
			return $this -> updateCampoEscrito_pergunta(
				array(		
					"escrito_id" => $this -> escrito_idEscrito_pergunta, 		
					"pergunta_id" => $this -> pergunta_idEscrito_pergunta, 		
					//"ordem" => $this -> ordemEscrito_pergunta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEscrito_pergunta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEscrito_pergunta && is_array($sets) ){
			$sql = "UPDATE escrito_pergunta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEscrito_pergunta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEscrito_pergunta($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM escrito_pergunta AS E ".$where;
    //echo "$sql";
		return $this -> executarQuery($sql);
	}
		
}
