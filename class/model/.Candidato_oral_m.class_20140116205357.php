<?php
class Candidato_oral_m extends Database { 
	
	// ATRIBUTOS
	protected $idCandidato_oral;
	protected $servico_candidato_idCandidato_oral;
	protected $servico_avaliador_idCandidato_oral;
	
	//CONSTRUTOR
	function __construct( $idCandidato_oral = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCandidato_oral) ){
		
			$array = $this -> selectCandidato_oral(" WHERE C.id = ".$this -> gravarBD($idCandidato_oral) );			
			
			$this -> idCandidato_oral = $array[0]['id'];
			$this -> servico_candidato_idCandidato_oral = $array[0]['servico_candidato_id'];
			$this -> servico_avaliador_idCandidato_oral = $array[0]['servico_avaliador_id'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCandidato_oral($valor) {
		$this -> idCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_candidato_idCandidato_oral($valor) {
		$this -> servico_candidato_idCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_avaliador_idCandidato_oral($valor) {
		$this -> servico_avaliador_idCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato_oral() {
		return ($this -> idCandidato_oral);
	}
	
	function get_servico_candidato_idCandidato_oral() {
		return ($this -> servico_candidato_idCandidato_oral);
	}
	
	function get_servico_avaliador_idCandidato_oral() {
		return ($this -> servico_avaliador_idCandidato_oral);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_oral() {
		$sql = "INSERT INTO candidato_oral 
		(servico_candidato_id, servico_avaliador_id) 
		VALUES (	
			" . $this -> servico_candidato_idCandidato_oral . ", 	
			" . $this -> servico_avaliador_idCandidato_oral . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCandidato_oral() {
		return $this -> updateCampoCandidato_oral(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateCandidato_oral() {
		if( $this -> idCandidato_oral ){
				
			return $this -> updateCampoCandidato_oral(
				array(		
					"servico_candidato_id" => $this -> servico_candidato_idCandidato_oral, 		
					"servico_avaliador_id" => $this -> servico_avaliador_idCandidato_oral				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCandidato_oral($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCandidato_oral && is_array($sets) ){
			$sql = "UPDATE candidato_oral SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCandidato_oral;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato_oral($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato_oral AS C ".$where;
		return $this -> executarQuery($sql);
	}
  
  function selectCandidato_oralJoin($where = "", $campos = array("CO.*") ) { 
    $sql = "SELECT SQL_CACHE ".implode(",", $campos)." 
    FROM candidato_oral AS CO 
    INNER JOIN servico_candidato AS SC ON SC.excluido = 0 AND SC.id = CO.servico_candidato_id  
    INNER JOIN servico AS S ON S.excluido = 0 AND S.id = SC.servico_id 
    INNER JOIN oral AS O ON O.excluido = 0 AND O.servico_id = S.id 
    ".$where;
    return $this -> executarQuery($sql);
  }
		
}
