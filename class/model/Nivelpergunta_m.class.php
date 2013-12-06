<?php
class Nivelpergunta_m extends Database { 
	
	// ATRIBUTOS
	protected $idNivelpergunta;
	protected $nomeNivelpergunta;
	protected $inativoNivelpergunta = 0;
	
	//CONSTRUTOR
	function __construct( $idNivelpergunta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idNivelpergunta) ){
		
			$array = $this -> selectNivelpergunta(" WHERE N.id = ".$this -> gravarBD($idNivelpergunta) );			
			
			$this -> idNivelpergunta = $array[0]['id'];
			$this -> nomeNivelpergunta = $array[0]['nome'];
			$this -> inativoNivelpergunta = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idNivelpergunta($valor) {
		$this -> idNivelpergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeNivelpergunta($valor) {
		$this -> nomeNivelpergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoNivelpergunta($valor) {
		$this -> inativoNivelpergunta = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idNivelpergunta() {
		return ($this -> idNivelpergunta);
	}
	
	function get_nomeNivelpergunta() {
		return ($this -> nomeNivelpergunta);
	}
	
	function get_inativoNivelpergunta($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoNivelpergunta : Uteis::exibirStatus(!$this -> inativoNivelpergunta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertNivelpergunta() {
		$sql = "INSERT INTO nivelpergunta 
		(nome, inativo) 
		VALUES (	
			" . $this -> nomeNivelpergunta . ", 	
			" . $this -> inativoNivelpergunta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteNivelpergunta() {
		return $this -> updateCampoNivelpergunta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateNivelpergunta() {
		if( $this -> idNivelpergunta ){
				
			return $this -> updateCampoNivelpergunta(
				array(		
					"nome" => $this -> nomeNivelpergunta, 		
					"inativo" => $this -> inativoNivelpergunta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoNivelpergunta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idNivelpergunta && is_array($sets) ){
			$sql = "UPDATE nivelpergunta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idNivelpergunta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectNivelpergunta($where = "", $campos = array("N.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM nivelpergunta AS N ".$where;
		return $this -> executarQuery($sql);
	}
		
}
