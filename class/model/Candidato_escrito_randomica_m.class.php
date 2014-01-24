<?php
class Candidato_escrito_randomica_m extends Database { 
	
	// ATRIBUTOS
	protected $idCandidato_escrito_randomica;
	protected $escrito_idCandidato_escrito_randomica;
	protected $servico_candidato_idCandidato_escrito_randomica;
	protected $servico_avaliador_idCandidato_escrito_randomica;
	protected $finalizadoCandidato_escrito_randomica = 0;
	
	//CONSTRUTOR
	function __construct( $idCandidato_escrito_randomica = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCandidato_escrito_randomica) ){		
			$array = $this -> selectCandidato_escrito_randomica(" WHERE C.id = ".$this -> gravarBD($idCandidato_escrito_randomica) );						
    }elseif( $idCandidato_escrito_randomica != "" ){
      $array = $this -> selectCandidato_escrito_randomica($idCandidato_escrito_randomica." LIMIT 1");
    }
    
    if( $array ){
			$this -> idCandidato_escrito_randomica = $array[0]['id'];
			$this -> escrito_idCandidato_escrito_randomica = $array[0]['escrito_id'];
			$this -> servico_candidato_idCandidato_escrito_randomica = $array[0]['servico_candidato_id'];
			$this -> servico_avaliador_idCandidato_escrito_randomica = $array[0]['servico_avaliador_id'];
			$this -> finalizadoCandidato_escrito_randomica = $array[0]['finalizado'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCandidato_escrito_randomica($valor) {
		$this -> idCandidato_escrito_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_idCandidato_escrito_randomica($valor) {
		$this -> escrito_idCandidato_escrito_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_candidato_idCandidato_escrito_randomica($valor) {
		$this -> servico_candidato_idCandidato_escrito_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_avaliador_idCandidato_escrito_randomica($valor) {
		$this -> servico_avaliador_idCandidato_escrito_randomica = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_finalizadoCandidato_escrito_randomica($valor) {
		$this -> finalizadoCandidato_escrito_randomica = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato_escrito_randomica() {
		return ($this -> idCandidato_escrito_randomica);
	}
	
	function get_escrito_idCandidato_escrito_randomica() {
		return ($this -> escrito_idCandidato_escrito_randomica);
	}
	
	function get_servico_candidato_idCandidato_escrito_randomica() {
		return ($this -> servico_candidato_idCandidato_escrito_randomica);
	}
	
	function get_servico_avaliador_idCandidato_escrito_randomica() {
		return ($this -> servico_avaliador_idCandidato_escrito_randomica);
	}
	
	function get_finalizadoCandidato_escrito_randomica($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> finalizadoCandidato_escrito_randomica : Uteis::exibirStatus($this -> finalizadoCandidato_escrito_randomica);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_escrito_randomica() {
		$sql = "INSERT INTO candidato_escrito_randomica 
		(escrito_id, servico_candidato_id, servico_avaliador_id, finalizado) 
		VALUES (	
			" . $this -> escrito_idCandidato_escrito_randomica . ", 	
			" . $this -> servico_candidato_idCandidato_escrito_randomica . ", 	
			" . $this -> servico_avaliador_idCandidato_escrito_randomica . ", 	
			" . $this -> finalizadoCandidato_escrito_randomica . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCandidato_escrito_randomica() {
		return $this -> updateCampoCandidato_escrito_randomica(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateCandidato_escrito_randomica() {
		if( $this -> idCandidato_escrito_randomica ){
				
			return $this -> updateCampoCandidato_escrito_randomica(
				array(		
					"escrito_id" => $this -> escrito_idCandidato_escrito_randomica, 		
					"servico_candidato_id" => $this -> servico_candidato_idCandidato_escrito_randomica, 		
					"servico_avaliador_id" => $this -> servico_avaliador_idCandidato_escrito_randomica, 		
					"finalizado" => $this -> finalizadoCandidato_escrito_randomica				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCandidato_escrito_randomica($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCandidato_escrito_randomica && is_array($sets) ){
			$sql = "UPDATE candidato_escrito_randomica SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCandidato_escrito_randomica;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato_escrito_randomica($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato_escrito_randomica AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
