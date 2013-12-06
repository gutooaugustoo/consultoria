<?php
class Escola_m extends Database { 
	
	// ATRIBUTOS
	protected $idEscola;
	protected $nomeEscola;
	protected $inativoEscola = 0;
	
	//CONSTRUTOR
	function __construct( $idEscola = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEscola) ){
		
			$array = $this -> selectEscola(" WHERE E.id = ".$this -> gravarBD($idEscola) );			
			
			$this -> idEscola = $array[0]['id'];
			$this -> nomeEscola = $array[0]['nome'];
			$this -> inativoEscola = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEscola($valor) {
		$this -> idEscola = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeEscola($valor) {
		$this -> nomeEscola = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoEscola($valor) {
		$this -> inativoEscola = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idEscola() {
		return ($this -> idEscola);
	}
	
	function get_nomeEscola() {
		return ($this -> nomeEscola);
	}
	
	function get_inativoEscola($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoEscola : Uteis::exibirStatus(!$this -> inativoEscola);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEscola() {
		$sql = "INSERT INTO escola 
		(nome, inativo) 
		VALUES (	
			" . $this -> nomeEscola . ", 	
			" . $this -> inativoEscola . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEscola() {
		return $this -> updateCampoEscola(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEscola() {
		if( $this -> idEscola ){
				
			return $this -> updateCampoEscola(
				array(		
					"nome" => $this -> nomeEscola, 		
					"inativo" => $this -> inativoEscola				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEscola($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEscola && is_array($sets) ){
			$sql = "UPDATE escola SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEscola;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEscola($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM escola AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
