<?php
class Redacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idRedacao;
	protected $servico_idRedacao;
	protected $etapa_idRedacao;
	protected $tempoParaFinalizacaoRedacao;
	protected $minimoLinhasRedacao;
	protected $maximoLinhasRedacao;
	protected $temPlanoAcaoRedacao = 0;
	
	//CONSTRUTOR
	function __construct( $idRedacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idRedacao) ){		
			$array = $this -> selectRedacao(" WHERE R.id = ".$this -> gravarBD($idRedacao) );						
    }elseif( $idRedacao != "" ){
      $array = $this -> selectRedacao($idRedacao." LIMIT 1");
    }
    
    if( $array ){
			$this -> idRedacao = $array[0]['id'];
			$this -> servico_idRedacao = $array[0]['servico_id'];
			$this -> etapa_idRedacao = $array[0]['etapa_id'];
			$this -> tempoParaFinalizacaoRedacao = $array[0]['tempoParaFinalizacao'];
			$this -> minimoLinhasRedacao = $array[0]['minimoLinhas'];
			$this -> maximoLinhasRedacao = $array[0]['maximoLinhas'];
			$this -> temPlanoAcaoRedacao = $array[0]['temPlanoAcao'];
			
		}
		
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idRedacao($valor) {
		$this -> idRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idRedacao($valor) {
		$this -> servico_idRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_etapa_idRedacao($valor) {
		$this -> etapa_idRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tempoParaFinalizacaoRedacao($valor) {
		$this -> tempoParaFinalizacaoRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_minimoLinhasRedacao($valor) {
		$this -> minimoLinhasRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_maximoLinhasRedacao($valor) {
		$this -> maximoLinhasRedacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_temPlanoAcaoRedacao($valor) {
		$this -> temPlanoAcaoRedacao = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idRedacao() {
		return ($this -> idRedacao);
	}
	
	function get_servico_idRedacao() {
		return ($this -> servico_idRedacao);
	}
	
	function get_etapa_idRedacao() {
		return ($this -> etapa_idRedacao);
	}
	
	function get_tempoParaFinalizacaoRedacao() {
		return ($this -> tempoParaFinalizacaoRedacao);
	}
	
	function get_minimoLinhasRedacao() {
		return ($this -> minimoLinhasRedacao);
	}
	
	function get_maximoLinhasRedacao() {
		return ($this -> maximoLinhasRedacao);
	}
	
	function get_temPlanoAcaoRedacao($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temPlanoAcaoRedacao : Uteis::exibirStatus($this -> temPlanoAcaoRedacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertRedacao() {
		$sql = "INSERT INTO redacao 
		(servico_id, etapa_id, tempoParaFinalizacao, minimoLinhas, maximoLinhas, temPlanoAcao) 
		VALUES (	
			" . $this -> servico_idRedacao . ", 	
			" . $this -> etapa_idRedacao . ", 	
			" . $this -> tempoParaFinalizacaoRedacao . ", 	
			" . $this -> minimoLinhasRedacao . ", 	
			" . $this -> maximoLinhasRedacao . ", 	
			" . $this -> temPlanoAcaoRedacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteRedacao() {
		return $this -> updateCampoRedacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateRedacao() {
		if( $this -> idRedacao ){
				
			return $this -> updateCampoRedacao(
				array(		
					"servico_id" => $this -> servico_idRedacao, 		
					"etapa_id" => $this -> etapa_idRedacao, 		
					"tempoParaFinalizacao" => $this -> tempoParaFinalizacaoRedacao, 		
					"minimoLinhas" => $this -> minimoLinhasRedacao, 		
					"maximoLinhas" => $this -> maximoLinhasRedacao, 		
					"temPlanoAcao" => $this -> temPlanoAcaoRedacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoRedacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idRedacao && is_array($sets) ){
			$sql = "UPDATE redacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idRedacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectRedacao($where = "", $campos = array("R.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM redacao AS R ".$where;
		return $this -> executarQuery($sql);
	}
		
}
