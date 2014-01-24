<?php
class Servico_candidato_m extends Database { 
	
	// ATRIBUTOS
	protected $idServico_candidato;
	protected $servico_idServico_candidato;
	protected $candidato_idServico_candidato;
	protected $dataValidadeServico_candidato;
	
	//CONSTRUTOR
	function __construct( $idServico_candidato = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idServico_candidato) ){
		
			$array = $this -> selectServico_candidato(" WHERE S.id = ".$this -> gravarBD($idServico_candidato) );			
			
			$this -> idServico_candidato = $array[0]['id'];
			$this -> servico_idServico_candidato = $array[0]['servico_id'];
			$this -> candidato_idServico_candidato = $array[0]['candidato_id'];
			$this -> dataValidadeServico_candidato = $array[0]['dataValidade'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idServico_candidato($valor) {
		$this -> idServico_candidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idServico_candidato($valor) {
		$this -> servico_idServico_candidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_candidato_idServico_candidato($valor) {
		$this -> candidato_idServico_candidato = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dataValidadeServico_candidato($valor) {
		$this -> dataValidadeServico_candidato = ($valor) ? $this -> gravarBD(Uteis::gravarData($valor)) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idServico_candidato() {
		return ($this -> idServico_candidato);
	}
	
	function get_servico_idServico_candidato() {
		return ($this -> servico_idServico_candidato);
	}
	
	function get_candidato_idServico_candidato() {
		return ($this -> candidato_idServico_candidato);
	}
	
	function get_dataValidadeServico_candidato() {
		if( $this -> dataValidadeServico_candidato ) return Uteis::exibirData($this -> dataValidadeServico_candidato);
	}
				
	//MANUSEANDO O BANCO
		
	function insertServico_candidato() {
		$sql = "INSERT INTO servico_candidato 
		(servico_id, candidato_id, dataValidade) 
		VALUES (	
			" . $this -> servico_idServico_candidato . ", 	
			" . $this -> candidato_idServico_candidato . ", 	
			" . $this -> dataValidadeServico_candidato . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteServico_candidato() {
		return $this -> updateCampoServico_candidato(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateServico_candidato() {
		if( $this -> idServico_candidato ){
				
			return $this -> updateCampoServico_candidato(
				array(		
					"servico_id" => $this -> servico_idServico_candidato, 		
					"candidato_id" => $this -> candidato_idServico_candidato, 		
					"dataValidade" => $this -> dataValidadeServico_candidato				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoServico_candidato($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idServico_candidato && is_array($sets) ){
			$sql = "UPDATE servico_candidato SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idServico_candidato;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectServico_candidato($where = "", $campos = array("S.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM servico_candidato AS S ".$where;
		return $this -> executarQuery($sql);
	}
  
  function selectServico_candidatoJoin($where = "", $campos = array("S.*") ) {  
    $sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM servico_candidato AS SC 
    INNER JOIN servico AS S ON S.id = SC.servico_id 
    INNER JOIN candidato AS C ON C.id = SC.candidato_id 
    INNER JOIN pessoa AS P ON P.id = C.id ".$where;
    //echo $sql;
    return $this -> executarQuery($sql);
  }
		
}
