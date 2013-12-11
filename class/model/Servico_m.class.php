<?php
class Servico_m extends Database { 
	
	// ATRIBUTOS
	protected $idServico;
	protected $empresa_idServico;
	protected $idioma_idServico;
	protected $servico_idServico;
	protected $descricaoServico;
	protected $dataInicioServico;
	protected $dataValidadeServico;
	protected $temOralServico = 0;
	protected $temEscritoServico = 0;
	protected $temRedacaoServico = 0;
	protected $temResultadoFinalServico = 0;
	protected $obsServico;
	protected $hashServico;
	
	//CONSTRUTOR
	function __construct( $idServico = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idServico) ){
		
			$array = $this -> selectServico(" WHERE S.id = ".$this -> gravarBD($idServico) );			
			
			$this -> idServico = $array[0]['id'];
			$this -> empresa_idServico = $array[0]['empresa_id'];
			$this -> idioma_idServico = $array[0]['idioma_id'];
			$this -> servico_idServico = $array[0]['servico_id'];
			$this -> descricaoServico = $array[0]['descricao'];
			$this -> dataInicioServico = $array[0]['dataInicio'];
			$this -> dataValidadeServico = $array[0]['dataValidade'];
			$this -> temOralServico = $array[0]['temOral'];
			$this -> temEscritoServico = $array[0]['temEscrito'];
			$this -> temRedacaoServico = $array[0]['temRedacao'];
			$this -> temResultadoFinalServico = $array[0]['temResultadoFinal'];
			$this -> obsServico = $array[0]['obs'];
			$this -> hashServico = $array[0]['hash'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idServico($valor) {
		$this -> idServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idServico($valor) {
		$this -> empresa_idServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idServico($valor) {
		$this -> idioma_idServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idServico($valor) {
		$this -> servico_idServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_descricaoServico($valor) {
		$this -> descricaoServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dataInicioServico($valor) {
		$this -> dataInicioServico = ($valor) ? $this -> gravarBD(Uteis::gravarData($valor)) : "NULL";
		return $this;
	}
	
	function set_dataValidadeServico($valor) {
		$this -> dataValidadeServico = ($valor) ? $this -> gravarBD(Uteis::gravarData($valor)) : "NULL";
		return $this;
	}
	
	function set_temOralServico($valor) {
		$this -> temOralServico = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_temEscritoServico($valor) {
		$this -> temEscritoServico = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_temRedacaoServico($valor) {
		$this -> temRedacaoServico = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_temResultadoFinalServico($valor) {
		$this -> temResultadoFinalServico = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_obsServico($valor) {
		$this -> obsServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_hashServico() {
		$valor = sha1($this->idServico.date('YmdHis'));
		$this -> hashServico = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idServico() {
		return ($this -> idServico);
	}
	
	function get_empresa_idServico() {
		return ($this -> empresa_idServico);
	}
	
	function get_idioma_idServico() {
		return ($this -> idioma_idServico);
	}
	
	function get_servico_idServico() {
		return ($this -> servico_idServico);
	}
	
	function get_descricaoServico() {
		return ($this -> descricaoServico);
	}
	
	function get_dataInicioServico() {
		if( $this -> dataInicioServico ) return Uteis::exibirData($this -> dataInicioServico);
	}
	
	function get_dataValidadeServico() {
		if( $this -> dataValidadeServico ) return Uteis::exibirData($this -> dataValidadeServico);
	}
	
	function get_temOralServico($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temOralServico : Uteis::exibirStatus($this -> temOralServico);
	}
	
	function get_temEscritoServico($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temEscritoServico : Uteis::exibirStatus($this -> temEscritoServico);
	}
	
	function get_temRedacaoServico($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temRedacaoServico : Uteis::exibirStatus($this -> temRedacaoServico);
	}
	
	function get_temResultadoFinalServico($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> temResultadoFinalServico : Uteis::exibirStatus($this -> temResultadoFinalServico);
	}
	
	function get_obsServico() {
		return ($this -> obsServico);
	}
	
	function get_hashServico() {
		return ($this -> hashServico);
	}
				
	//MANUSEANDO O BANCO
		
	function insertServico() {
		$sql = "INSERT INTO servico 
		(empresa_id, idioma_id, servico_id, descricao, dataInicio, dataValidade, temOral, temEscrito, temRedacao, temResultadoFinal, obs, hash) 
		VALUES (	
			" . $this -> empresa_idServico . ", 	
			" . $this -> idioma_idServico . ", 	
			" . $this -> servico_idServico . ", 	
			" . $this -> descricaoServico . ", 	
			" . $this -> dataInicioServico . ", 	
			" . $this -> dataValidadeServico . ", 	
			" . $this -> temOralServico . ", 	
			" . $this -> temEscritoServico . ", 	
			" . $this -> temRedacaoServico . ", 	
			" . $this -> temResultadoFinalServico . ", 	
			" . $this -> obsServico . ", 	
			" . $this -> hashServico . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteServico() {
		return $this -> updateCampoServico(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateServico() {
		if( $this -> idServico ){
				
			return $this -> updateCampoServico(
				array(		
					"empresa_id" => $this -> empresa_idServico, 		
					"idioma_id" => $this -> idioma_idServico, 		
					"servico_id" => $this -> servico_idServico, 		
					"descricao" => $this -> descricaoServico, 		
					"dataInicio" => $this -> dataInicioServico, 		
					"dataValidade" => $this -> dataValidadeServico, 		
					"temOral" => $this -> temOralServico, 		
					"temEscrito" => $this -> temEscritoServico, 		
					"temRedacao" => $this -> temRedacaoServico, 		
					"temResultadoFinal" => $this -> temResultadoFinalServico, 		
					"obs" => $this -> obsServico, 		
					//"hash" => $this -> hashServico				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoServico($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idServico && is_array($sets) ){
			$sql = "UPDATE servico SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idServico;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectServico($where = "", $campos = array("S.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM servico AS S ".$where;
		return $this -> executarQuery($sql);
	}
		
}
