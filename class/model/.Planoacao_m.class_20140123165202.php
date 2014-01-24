<?php
class Planoacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idPlanoacao;
	protected $tipoPlanoacao;
	protected $planoPlanoacao;
	
	//CONSTRUTOR
	function __construct( $idPlanoacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPlanoacao) ){
		
			$array = $this -> selectPlanoacao(" WHERE P.id = ".$this -> gravarBD($idPlanoacao) );			
			
			$this -> idPlanoacao = $array[0]['id'];
			$this -> tipoPlanoacao = $array[0]['tipo'];
			$this -> planoPlanoacao = $array[0]['plano'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPlanoacao($valor) {
		$this -> idPlanoacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tipoPlanoacao($valor) {
		$this -> tipoPlanoacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_planoPlanoacao($valor) {
		$this -> planoPlanoacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idPlanoacao() {
		return ($this -> idPlanoacao);
	}
	
	function get_tipoPlanoacao() {
		return ($this -> tipoPlanoacao);
	}
	
	function get_planoPlanoacao() {
		return ($this -> planoPlanoacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPlanoacao() {
		$sql = "INSERT INTO planoacao 
		(tipo, plano) 
		VALUES (	
			" . $this -> tipoPlanoacao . ", 	
			" . $this -> planoPlanoacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePlanoacao() {
		return $this -> updateCampoPlanoacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePlanoacao() {
		if( $this -> idPlanoacao ){
				
			return $this -> updateCampoPlanoacao(
				array(		
					"tipo" => $this -> tipoPlanoacao, 		
					"plano" => $this -> planoPlanoacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPlanoacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPlanoacao && is_array($sets) ){
			$sql = "UPDATE planoacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPlanoacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPlanoacao($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM planoacao AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
