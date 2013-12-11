<?php
class Servico_avaliador_m extends Database { 
	
	// ATRIBUTOS
	protected $idServico_avaliador;
	protected $servico_idServico_avaliador;
	protected $avaliador_idServico_avaliador;
	protected $valorServico_avaliador = 0;
	
	//CONSTRUTOR
	function __construct( $idServico_avaliador = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idServico_avaliador) ){
		
			$array = $this -> selectServico_avaliador(" WHERE S.id = ".$this -> gravarBD($idServico_avaliador) );			
			
			$this -> idServico_avaliador = $array[0]['id'];
			$this -> servico_idServico_avaliador = $array[0]['servico_id'];
			$this -> avaliador_idServico_avaliador = $array[0]['avaliador_id'];
			$this -> valorServico_avaliador = $array[0]['valor'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idServico_avaliador($valor) {
		$this -> idServico_avaliador = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idServico_avaliador($valor) {
		$this -> servico_idServico_avaliador = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_avaliador_idServico_avaliador($valor) {
		$this -> avaliador_idServico_avaliador = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_valorServico_avaliador($valor) {
		$this -> valorServico_avaliador = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idServico_avaliador() {
		return ($this -> idServico_avaliador);
	}
	
	function get_servico_idServico_avaliador() {
		return ($this -> servico_idServico_avaliador);
	}
	
	function get_avaliador_idServico_avaliador() {
		return ($this -> avaliador_idServico_avaliador);
	}
	
	function get_valorServico_avaliador() {
		return ($this -> valorServico_avaliador);
	}
				
	//MANUSEANDO O BANCO
		
	function insertServico_avaliador() {
		$sql = "INSERT INTO servico_avaliador 
		(servico_id, avaliador_id, valor) 
		VALUES (	
			" . $this -> servico_idServico_avaliador . ", 	
			" . $this -> avaliador_idServico_avaliador . ", 	
			" . $this -> valorServico_avaliador . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteServico_avaliador() {
		return $this -> updateCampoServico_avaliador(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateServico_avaliador() {
		if( $this -> idServico_avaliador ){
				
			return $this -> updateCampoServico_avaliador(
				array(		
					"servico_id" => $this -> servico_idServico_avaliador, 		
					"avaliador_id" => $this -> avaliador_idServico_avaliador, 		
					"valor" => $this -> valorServico_avaliador				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoServico_avaliador($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idServico_avaliador && is_array($sets) ){
			$sql = "UPDATE servico_avaliador SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idServico_avaliador;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectServico_avaliador($where = "", $campos = array("S.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM servico_avaliador AS S ".$where;
		return $this -> executarQuery($sql);
	}
		
}
