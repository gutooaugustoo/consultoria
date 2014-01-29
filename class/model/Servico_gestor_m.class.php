<?php
class Servico_gestor_m extends Database { 
	
	// ATRIBUTOS
	protected $idServico_gestor;
	protected $servico_idServico_gestor;
	protected $gestor_idServico_gestor;
	
	//CONSTRUTOR
	function __construct( $idServico_gestor = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idServico_gestor) ){
		
			$array = $this -> selectServico_gestor(" WHERE S.id = ".$this -> gravarBD($idServico_gestor) );			
			
			$this -> idServico_gestor = $array[0]['id'];
			$this -> servico_idServico_gestor = $array[0]['servico_id'];
			$this -> gestor_idServico_gestor = $array[0]['gestor_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idServico_gestor($valor) {
		$this -> idServico_gestor = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idServico_gestor($valor) {
		$this -> servico_idServico_gestor = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_gestor_idServico_gestor($valor) {
		$this -> gestor_idServico_gestor = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idServico_gestor() {
		return ($this -> idServico_gestor);
	}
	
	function get_servico_idServico_gestor() {
		return ($this -> servico_idServico_gestor);
	}
	
	function get_gestor_idServico_gestor() {
		return ($this -> gestor_idServico_gestor);
	}
				
	//MANUSEANDO O BANCO
		
	function insertServico_gestor() {
		$sql = "INSERT INTO servico_gestor 
		(servico_id, gestor_id) 
		VALUES (	
			" . $this -> servico_idServico_gestor . ", 	
			" . $this -> gestor_idServico_gestor . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteServico_gestor() {
		return $this -> updateCampoServico_gestor(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateServico_gestor() {
		if( $this -> idServico_gestor ){
				
			return $this -> updateCampoServico_gestor(
				array(		
					"servico_id" => $this -> servico_idServico_gestor, 		
					"gestor_id" => $this -> gestor_idServico_gestor				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoServico_gestor($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idServico_gestor && is_array($sets) ){
			$sql = "UPDATE servico_gestor SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idServico_gestor;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectServico_gestor($where = "", $campos = array("S.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM servico_gestor AS S ".$where;
		return $this -> executarQuery($sql);
	}
		
}
