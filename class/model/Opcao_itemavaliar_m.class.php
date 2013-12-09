<?php
class Opcao_itemavaliar_m extends Database { 
	
	// ATRIBUTOS
	protected $idOpcao_itemavaliar;
	protected $itemAvaliarOral_idOpcao_itemavaliar;
	protected $opcaoOpcao_itemavaliar;
	
	//CONSTRUTOR
	function __construct( $idOpcao_itemavaliar = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idOpcao_itemavaliar) ){
		
			$array = $this -> selectOpcao_itemavaliar(" WHERE O.id = ".$this -> gravarBD($idOpcao_itemavaliar) );			
			
			$this -> idOpcao_itemavaliar = $array[0]['id'];
			$this -> itemAvaliarOral_idOpcao_itemavaliar = $array[0]['itemAvaliarOral_id'];
			$this -> opcaoOpcao_itemavaliar = $array[0]['opcao'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idOpcao_itemavaliar($valor) {
		$this -> idOpcao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_itemAvaliarOral_idOpcao_itemavaliar($valor) {
		$this -> itemAvaliarOral_idOpcao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_opcaoOpcao_itemavaliar($valor) {
		$this -> opcaoOpcao_itemavaliar = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idOpcao_itemavaliar() {
		return ($this -> idOpcao_itemavaliar);
	}
	
	function get_itemAvaliarOral_idOpcao_itemavaliar() {
		return ($this -> itemAvaliarOral_idOpcao_itemavaliar);
	}
	
	function get_opcaoOpcao_itemavaliar() {
		return ($this -> opcaoOpcao_itemavaliar);
	}
				
	//MANUSEANDO O BANCO
		
	function insertOpcao_itemavaliar() {
		$sql = "INSERT INTO opcao_itemavaliar 
		(itemAvaliarOral_id, opcao) 
		VALUES (	
			" . $this -> itemAvaliarOral_idOpcao_itemavaliar . ", 	
			" . $this -> opcaoOpcao_itemavaliar . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteOpcao_itemavaliar() {
		return $this -> updateCampoOpcao_itemavaliar(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateOpcao_itemavaliar() {
		if( $this -> idOpcao_itemavaliar ){
				
			return $this -> updateCampoOpcao_itemavaliar(
				array(		
					"itemAvaliarOral_id" => $this -> itemAvaliarOral_idOpcao_itemavaliar, 		
					"opcao" => $this -> opcaoOpcao_itemavaliar				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoOpcao_itemavaliar($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idOpcao_itemavaliar && is_array($sets) ){
			$sql = "UPDATE opcao_itemavaliar SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idOpcao_itemavaliar;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectOpcao_itemavaliar($where = "", $campos = array("O.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM opcao_itemavaliar AS O ".$where;
		return $this -> executarQuery($sql);
	}
		
}
