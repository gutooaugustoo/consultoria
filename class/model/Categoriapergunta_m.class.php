<?php
class Categoriapergunta_m extends Database { 
	
	// ATRIBUTOS
	protected $idCategoriapergunta;
	protected $nomeCategoriapergunta;
	protected $inativoCategoriapergunta = 0;
	
	//CONSTRUTOR
	function __construct( $idCategoriapergunta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCategoriapergunta) ){
		
			$array = $this -> selectCategoriapergunta(" WHERE C.id = ".$this -> gravarBD($idCategoriapergunta) );			
			
			$this -> idCategoriapergunta = $array[0]['id'];
			$this -> nomeCategoriapergunta = $array[0]['nome'];
			$this -> inativoCategoriapergunta = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCategoriapergunta($valor) {
		$this -> idCategoriapergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeCategoriapergunta($valor) {
		$this -> nomeCategoriapergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoCategoriapergunta($valor) {
		$this -> inativoCategoriapergunta = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idCategoriapergunta() {
		return ($this -> idCategoriapergunta);
	}
	
	function get_nomeCategoriapergunta() {
		return ($this -> nomeCategoriapergunta);
	}
	
	function get_inativoCategoriapergunta($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoCategoriapergunta : Uteis::exibirStatus(!$this -> inativoCategoriapergunta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCategoriapergunta() {
		$sql = "INSERT INTO categoriapergunta 
		(nome, inativo) 
		VALUES (	
			" . $this -> nomeCategoriapergunta . ", 	
			" . $this -> inativoCategoriapergunta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCategoriapergunta() {
		return $this -> updateCampoCategoriapergunta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateCategoriapergunta() {
		if( $this -> idCategoriapergunta ){
				
			return $this -> updateCampoCategoriapergunta(
				array(		
					"nome" => $this -> nomeCategoriapergunta, 		
					"inativo" => $this -> inativoCategoriapergunta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCategoriapergunta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCategoriapergunta && is_array($sets) ){
			$sql = "UPDATE categoriapergunta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCategoriapergunta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCategoriapergunta($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM categoriapergunta AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
