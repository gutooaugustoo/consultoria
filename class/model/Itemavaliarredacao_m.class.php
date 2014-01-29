<?php
class Itemavaliarredacao_m extends Database { 
	
	// ATRIBUTOS
	protected $idItemavaliarredacao;
	protected $enunciadoItemavaliarredacao;
	protected $dicaComoResponderItemavaliarredacao;
	protected $inativoItemavaliarredacao = 0;
	protected $padraoItemavaliarredacao = 0;
	
	//CONSTRUTOR
	function __construct( $idItemavaliarredacao = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idItemavaliarredacao) ){
		
			$array = $this -> selectItemavaliarredacao(" WHERE I.id = ".$this -> gravarBD($idItemavaliarredacao) );			
			
			$this -> idItemavaliarredacao = $array[0]['id'];
			$this -> enunciadoItemavaliarredacao = $array[0]['enunciado'];
			$this -> dicaComoResponderItemavaliarredacao = $array[0]['dicaComoResponder'];
			$this -> inativoItemavaliarredacao = $array[0]['inativo'];
			$this -> padraoItemavaliarredacao = $array[0]['padrao'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idItemavaliarredacao($valor) {
		$this -> idItemavaliarredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_enunciadoItemavaliarredacao($valor) {
		$this -> enunciadoItemavaliarredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dicaComoResponderItemavaliarredacao($valor) {
		$this -> dicaComoResponderItemavaliarredacao = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoItemavaliarredacao($valor) {
		$this -> inativoItemavaliarredacao = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
	
	function set_padraoItemavaliarredacao($valor) {
		$this -> padraoItemavaliarredacao = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idItemavaliarredacao() {
		return ($this -> idItemavaliarredacao);
	}
	
	function get_enunciadoItemavaliarredacao() {
		return ($this -> enunciadoItemavaliarredacao);
	}
	
	function get_dicaComoResponderItemavaliarredacao() {
		return ($this -> dicaComoResponderItemavaliarredacao);
	}
	
	function get_inativoItemavaliarredacao($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoItemavaliarredacao : Uteis::exibirStatus(!$this -> inativoItemavaliarredacao);
	}
	
	function get_padraoItemavaliarredacao($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> padraoItemavaliarredacao : Uteis::exibirStatus($this -> padraoItemavaliarredacao);
	}
				
	//MANUSEANDO O BANCO
		
	function insertItemavaliarredacao() {
		$sql = "INSERT INTO itemavaliarredacao 
		(enunciado, dicaComoResponder, inativo, padrao) 
		VALUES (	
			" . $this -> enunciadoItemavaliarredacao . ", 	
			" . $this -> dicaComoResponderItemavaliarredacao . ", 	
			" . $this -> inativoItemavaliarredacao . ", 	
			" . $this -> padraoItemavaliarredacao . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteItemavaliarredacao() {
		return $this -> updateCampoItemavaliarredacao(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateItemavaliarredacao() {
		if( $this -> idItemavaliarredacao ){
				
			return $this -> updateCampoItemavaliarredacao(
				array(		
					"enunciado" => $this -> enunciadoItemavaliarredacao, 		
					"dicaComoResponder" => $this -> dicaComoResponderItemavaliarredacao, 		
					"inativo" => $this -> inativoItemavaliarredacao, 		
					"padrao" => $this -> padraoItemavaliarredacao				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoItemavaliarredacao($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idItemavaliarredacao && is_array($sets) ){
			$sql = "UPDATE itemavaliarredacao SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idItemavaliarredacao;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectItemavaliarredacao($where = "", $campos = array("I.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM itemavaliarredacao AS I ".$where;
		return $this -> executarQuery($sql);
	}
		
}
