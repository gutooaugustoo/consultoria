<?php
class Candidato_escrito_m extends Database { 
	
	// ATRIBUTOS
	protected $idCandidato_escrito;
	protected $escrito_idCandidato_escrito;
	protected $servico_candidato_idCandidato_escrito;
	protected $servico_avaliador_idCandidato_escrito;
	protected $finalizadoCandidato_escrito = 0;
	
	//CONSTRUTOR
	function __construct( $idCandidato_escrito = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCandidato_escrito) ){		
			$array = $this -> selectCandidato_escrito(" WHERE C.id = ".$this -> gravarBD($idCandidato_escrito) );						
    }elseif( $idCandidato_escrito != "" ){ {
      $array = $this -> selectCandidato_escrito($idCandidato_escrito." LIMIT 1");
    }
    
    if( $array ){
      
			$this -> idCandidato_escrito = $array[0]['id'];
			$this -> escrito_idCandidato_escrito = $array[0]['escrito_id'];
			$this -> servico_candidato_idCandidato_escrito = $array[0]['servico_candidato_id'];
			$this -> servico_avaliador_idCandidato_escrito = $array[0]['servico_avaliador_id'];
			$this -> finalizadoCandidato_escrito = $array[0]['finalizado'];			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCandidato_escrito($valor) {
		$this -> idCandidato_escrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_idCandidato_escrito($valor) {
		$this -> escrito_idCandidato_escrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_candidato_idCandidato_escrito($valor) {
		$this -> servico_candidato_idCandidato_escrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_avaliador_idCandidato_escrito($valor) {
		$this -> servico_avaliador_idCandidato_escrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_finalizadoCandidato_escrito($valor) {
		$this -> finalizadoCandidato_escrito = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato_escrito() {
		return ($this -> idCandidato_escrito);
	}
	
	function get_escrito_idCandidato_escrito() {
		return ($this -> escrito_idCandidato_escrito);
	}
	
	function get_servico_candidato_idCandidato_escrito() {
		return ($this -> servico_candidato_idCandidato_escrito);
	}
	
	function get_servico_avaliador_idCandidato_escrito() {
		return ($this -> servico_avaliador_idCandidato_escrito);
	}
	
	function get_finalizadoCandidato_escrito($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> finalizadoCandidato_escrito : Uteis::exibirStatus($this -> finalizadoCandidato_escrito);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_escrito() {
		$sql = "INSERT INTO candidato_escrito 
		(escrito_id, servico_candidato_id, servico_avaliador_id, finalizado) 
		VALUES (	
			" . $this -> escrito_idCandidato_escrito . ", 	
			" . $this -> servico_candidato_idCandidato_escrito . ", 	
			" . $this -> servico_avaliador_idCandidato_escrito . ", 	
			" . $this -> finalizadoCandidato_escrito . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCandidato_escrito() {
		return $this -> updateCampoCandidato_escrito(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateCandidato_escrito() {
		if( $this -> idCandidato_escrito ){
				
			return $this -> updateCampoCandidato_escrito(
				array(		
					"escrito_id" => $this -> escrito_idCandidato_escrito, 		
					"servico_candidato_id" => $this -> servico_candidato_idCandidato_escrito, 		
					"servico_avaliador_id" => $this -> servico_avaliador_idCandidato_escrito, 		
					"finalizado" => $this -> finalizadoCandidato_escrito				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCandidato_escrito($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCandidato_escrito && is_array($sets) ){
			$sql = "UPDATE candidato_escrito SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCandidato_escrito;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato_escrito($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato_escrito AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
