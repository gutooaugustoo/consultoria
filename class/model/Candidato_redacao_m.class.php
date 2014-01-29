<?php
class Candidato_redacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idCandidato_redacao;
	protected $redacao_idCandidato_redacao;
	protected $redacao_temaRedacao_idCandidato_redacao;
	protected $servico_candidato_idCandidato_redacao;
	protected $servico_avaliador_idCandidato_redacao;
	protected $redacaoCandidato_redacao;
	protected $correcaoCandidato_redacao;
	protected $finalizadoCandidato_redacao = 0;
	
	//CONSTRUTOR
	function __construct( $idCandidato_redacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idCandidato_redacao) ){		
			$array = $this -> selectCandidato_redacao(" WHERE C.id = ".$this -> gravarBD($idCandidato_redacao) );						
    }elseif( $idCandidato_redacao != "" ){
      $array = $this -> selectCandidato_redacao($idCandidato_redacao." LIMIT 1");
    }
    
    if( $array ){
			$this -> idCandidato_redacao = $array[0]['id'];
			$this -> redacao_idCandidato_redacao = $array[0]['redacao_id'];
			$this -> redacao_temaRedacao_idCandidato_redacao = $array[0]['redacao_temaRedacao_id'];
			$this -> servico_candidato_idCandidato_redacao = $array[0]['servico_candidato_id'];
			$this -> servico_avaliador_idCandidato_redacao = $array[0]['servico_avaliador_id'];
			$this -> redacaoCandidato_redacao = $array[0]['redacao'];
			$this -> correcaoCandidato_redacao = $array[0]['correcao'];
			$this -> finalizadoCandidato_redacao = $array[0]['finalizado'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idCandidato_redacao($valor) {
		$this -> idCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_redacao_idCandidato_redacao($valor) {
		$this -> redacao_idCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_redacao_temaRedacao_idCandidato_redacao($valor) {
		$this -> redacao_temaRedacao_idCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_candidato_idCandidato_redacao($valor) {
		$this -> servico_candidato_idCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_avaliador_idCandidato_redacao($valor) {
		$this -> servico_avaliador_idCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_redacaoCandidato_redacao($valor) {
		$this -> redacaoCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_correcaoCandidato_redacao($valor) {
		$this -> correcaoCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_finalizadoCandidato_redacao($valor) {
		$this -> finalizadoCandidato_redacao = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idCandidato_redacao() {
		return ($this -> idCandidato_redacao);
	}
	
	function get_redacao_idCandidato_redacao() {
		return ($this -> redacao_idCandidato_redacao);
	}
	
	function get_redacao_temaRedacao_idCandidato_redacao() {
		return ($this -> redacao_temaRedacao_idCandidato_redacao);
	}
	
	function get_servico_candidato_idCandidato_redacao() {
		return ($this -> servico_candidato_idCandidato_redacao);
	}
	
	function get_servico_avaliador_idCandidato_redacao() {
		return ($this -> servico_avaliador_idCandidato_redacao);
	}
	
	function get_redacaoCandidato_redacao() {
		return ($this -> redacaoCandidato_redacao);
	}
	
	function get_correcaoCandidato_redacao() {
		return ($this -> correcaoCandidato_redacao);
	}
	
	function get_finalizadoCandidato_redacao($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> finalizadoCandidato_redacao : Uteis::exibirStatus($this -> finalizadoCandidato_redacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_redacao() {
		$sql = "INSERT INTO candidato_redacao 
		(redacao_id, redacao_temaRedacao_id, servico_candidato_id, servico_avaliador_id, redacao, correcao, finalizado) 
		VALUES (	
			" . $this -> redacao_idCandidato_redacao . ", 	
			" . $this -> redacao_temaRedacao_idCandidato_redacao . ", 	
			" . $this -> servico_candidato_idCandidato_redacao . ", 	
			" . $this -> servico_avaliador_idCandidato_redacao . ", 	
			" . $this -> redacaoCandidato_redacao . ", 	
			" . $this -> correcaoCandidato_redacao . ", 	
			" . $this -> finalizadoCandidato_redacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCandidato_redacao() {
		return $this -> updateCampoCandidato_redacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateCandidato_redacao() {
		if( $this -> idCandidato_redacao ){
				
			return $this -> updateCampoCandidato_redacao(
				array(		
					"redacao_id" => $this -> redacao_idCandidato_redacao, 		
					"redacao_temaRedacao_id" => $this -> redacao_temaRedacao_idCandidato_redacao, 		
					"servico_candidato_id" => $this -> servico_candidato_idCandidato_redacao, 		
					"servico_avaliador_id" => $this -> servico_avaliador_idCandidato_redacao, 		
					"redacao" => $this -> redacaoCandidato_redacao, 		
					"correcao" => $this -> correcaoCandidato_redacao, 		
					"finalizado" => $this -> finalizadoCandidato_redacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoCandidato_redacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idCandidato_redacao && is_array($sets) ){
			$sql = "UPDATE candidato_redacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idCandidato_redacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato_redacao($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato_redacao AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
