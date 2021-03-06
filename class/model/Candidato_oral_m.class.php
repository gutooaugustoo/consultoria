<?php
class Candidato_oral_m extends Database { 
	
	// ATRIBUTOS
	protected $idCandidato_oral;
	protected $oral_idCandidato_oral;
	protected $servico_candidato_idCandidato_oral;
	protected $servico_avaliador_idCandidato_oral;
	protected $videoCandidato_oral;
	protected $finalizadoCandidato_oral = 0;
	
	//CONSTRUTOR
	function __construct( $idCandidato_oral = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCandidato_oral) ){		
			$array = $this -> selectCandidato_oral(" WHERE C.id = ".$this -> gravarBD($idCandidato_oral) );						
    }elseif( $idCandidato_oral != "" ){
      $array = $this -> selectCandidato_oral($idCandidato_oral." LIMIT 1");
    }
    
    if( $array ){
			$this -> idCandidato_oral = $array[0]['id'];
			$this -> oral_idCandidato_oral = $array[0]['oral_id'];
			$this -> servico_candidato_idCandidato_oral = $array[0]['servico_candidato_id'];
			$this -> servico_avaliador_idCandidato_oral = $array[0]['servico_avaliador_id'];
			$this -> videoCandidato_oral = $array[0]['video'];
			$this -> finalizadoCandidato_oral = $array[0]['finalizado'];
			
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
	
	function set_oral_idCandidato_oral($valor) {
		$this -> oral_idCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
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
	
	function set_videoCandidato_oral($valor) {
		$this -> videoCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_finalizadoCandidato_oral($valor) {
		$this -> finalizadoCandidato_oral = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato_oral() {
		return ($this -> idCandidato_oral);
	}
	
	function get_oral_idCandidato_oral() {
		return ($this -> oral_idCandidato_oral);
	}
	
	function get_servico_candidato_idCandidato_oral() {
		return ($this -> servico_candidato_idCandidato_oral);
	}
	
	function get_servico_avaliador_idCandidato_oral() {
		return ($this -> servico_avaliador_idCandidato_oral);
	}
	
	function get_videoCandidato_oral() {
		return ($this -> videoCandidato_oral);
	}
	
	function get_finalizadoCandidato_oral($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> finalizadoCandidato_oral : Uteis::exibirStatus($this -> finalizadoCandidato_oral);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_oral() {
		$sql = "INSERT INTO candidato_oral 
		(oral_id, servico_candidato_id, servico_avaliador_id, video, finalizado) 
		VALUES (	
			" . $this -> oral_idCandidato_oral . ", 	
			" . $this -> servico_candidato_idCandidato_oral . ", 	
			" . $this -> servico_avaliador_idCandidato_oral . ", 	
			" . $this -> videoCandidato_oral . ", 	
			" . $this -> finalizadoCandidato_oral . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
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
					"oral_id" => $this -> oral_idCandidato_oral, 		
					"servico_candidato_id" => $this -> servico_candidato_idCandidato_oral, 		
					"servico_avaliador_id" => $this -> servico_avaliador_idCandidato_oral, 		
					"video" => $this -> videoCandidato_oral, 		
					"finalizado" => $this -> finalizadoCandidato_oral				
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
		
}
