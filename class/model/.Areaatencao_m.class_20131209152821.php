<?php
class Areaatencao_m extends Database { 
	
	// ATRIBUTOS
	protected $idAreaatencao;
	protected $idioma_idAreaatencao;
	protected $descricaoAreaatencao;
	
	//CONSTRUTOR
	function __construct( $idAreaatencao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idAreaatencao) ){
		
			$array = $this -> selectAreaatencao(" WHERE A.id = ".$this -> gravarBD($idAreaatencao) );			
			
			$this -> idAreaatencao = $array[0]['id'];
			$this -> idioma_idAreaatencao = $array[0]['idioma_id'];
			$this -> descricaoAreaatencao = $array[0]['descricao'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idAreaatencao($valor) {
		$this -> idAreaatencao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idAreaatencao($valor) {
		$this -> idioma_idAreaatencao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descricaoAreaatencao($valor) {
		$this -> descricaoAreaatencao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idAreaatencao() {
		return ($this -> idAreaatencao);
	}
	
	function get_idioma_idAreaatencao() {
		return ($this -> idioma_idAreaatencao);
	}
	
	function get_descricaoAreaatencao() {
		return ($this -> descricaoAreaatencao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertAreaatencao() {
		$sql = "INSERT INTO areaatencao 
		(idioma_id, descricao) 
		VALUES (	
			" . $this -> idioma_idAreaatencao . ", 	
			" . $this -> descricaoAreaatencao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteAreaatencao() {
		return $this -> updateCampoAreaatencao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateAreaatencao() {
		if( $this -> idAreaatencao ){
				
			return $this -> updateCampoAreaatencao(
				array(		
					"idioma_id" => $this -> idioma_idAreaatencao, 		
					"descricao" => $this -> descricaoAreaatencao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoAreaatencao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idAreaatencao && is_array($sets) ){
			$sql = "UPDATE areaatencao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idAreaatencao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectAreaatencao($where = "", $campos = array("A.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM areaatencao AS A ".$where;
		return $this -> executarQuery($sql);
	}
		
}
