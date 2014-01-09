<?php
class Pergunta_m extends Database { 
	
	// ATRIBUTOS
	protected $idPergunta;
	protected $tipoPergunta_idPergunta;
	protected $pergunta_idPergunta;
	protected $empresa_idPergunta;
	protected $idioma_idPergunta;
	protected $nivelPergunta_idPergunta;
	protected $categoriaPergunta_idPergunta;
	protected $tituloPergunta;
	protected $enunciadoPergunta;
	protected $tempoRespostaPergunta;
	protected $inativoPergunta = 0;
	
	//CONSTRUTOR
	function __construct( $idPergunta = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPergunta) ){
		
			$array = $this -> selectPergunta(" WHERE P.id = ".$this -> gravarBD($idPergunta) );			
			
			$this -> idPergunta = $array[0]['id'];
			$this -> tipoPergunta_idPergunta = $array[0]['tipoPergunta_id'];
			$this -> pergunta_idPergunta = $array[0]['pergunta_id'];
			$this -> empresa_idPergunta = $array[0]['empresa_id'];
			$this -> idioma_idPergunta = $array[0]['idioma_id'];
			$this -> nivelPergunta_idPergunta = $array[0]['nivelPergunta_id'];
			$this -> categoriaPergunta_idPergunta = $array[0]['categoriaPergunta_id'];
			$this -> tituloPergunta = $array[0]['titulo'];
			$this -> enunciadoPergunta = $array[0]['enunciado'];
			$this -> tempoRespostaPergunta = $array[0]['tempoResposta'];
			$this -> inativoPergunta = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPergunta($valor) {
		$this -> idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tipoPergunta_idPergunta($valor) {
		$this -> tipoPergunta_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pergunta_idPergunta($valor) {
		$this -> pergunta_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_empresa_idPergunta($valor) {
		$this -> empresa_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_idioma_idPergunta($valor) {
		$this -> idioma_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nivelPergunta_idPergunta($valor) {
		$this -> nivelPergunta_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_categoriaPergunta_idPergunta($valor) {
		$this -> categoriaPergunta_idPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tituloPergunta($valor) {
		$this -> tituloPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_enunciadoPergunta($valor) {
		$this -> enunciadoPergunta = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tempoRespostaPergunta($valor) {
		$this -> tempoRespostaPergunta = ($valor) ? $this -> gravarBD( Uteis::gravarHoras($valor) ) : "NULL";
		return $this;
	}
	
	function set_inativoPergunta($valor) {
		$this -> inativoPergunta = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idPergunta() {
		return ($this -> idPergunta);
	}
	
	function get_tipoPergunta_idPergunta() {
		return ($this -> tipoPergunta_idPergunta);
	}
	
	function get_pergunta_idPergunta() {
		return ($this -> pergunta_idPergunta);
	}
	
	function get_empresa_idPergunta() {
		return ($this -> empresa_idPergunta);
	}
	
	function get_idioma_idPergunta() {
		return ($this -> idioma_idPergunta);
	}
	
	function get_nivelPergunta_idPergunta() {
		return ($this -> nivelPergunta_idPergunta);
	}
	
	function get_categoriaPergunta_idPergunta() {
		return ($this -> categoriaPergunta_idPergunta);
	}
	
	function get_tituloPergunta() {
		return ($this -> tituloPergunta);
	}
	
	function get_enunciadoPergunta() {
		return ($this -> enunciadoPergunta);
	}
	
	function get_tempoRespostaPergunta() {
		return Uteis::exibirHorasInput($this -> tempoRespostaPergunta);
	}
	
	function get_inativoPergunta($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoPergunta : Uteis::exibirStatus(!$this -> inativoPergunta);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPergunta() {
		$sql = "INSERT INTO pergunta 
		(tipoPergunta_id, pergunta_id, empresa_id, idioma_id, nivelPergunta_id, categoriaPergunta_id, titulo, enunciado, tempoResposta, inativo) 
		VALUES (	
			" . $this -> tipoPergunta_idPergunta . ", 	
			" . $this -> pergunta_idPergunta . ", 	
			" . $this -> empresa_idPergunta . ", 	
			" . $this -> idioma_idPergunta . ", 	
			" . $this -> nivelPergunta_idPergunta . ", 	
			" . $this -> categoriaPergunta_idPergunta . ", 	
			" . $this -> tituloPergunta . ", 	
			" . $this -> enunciadoPergunta . ", 	
			" . $this -> tempoRespostaPergunta . ", 	
			" . $this -> inativoPergunta . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePergunta() {
		return $this -> updateCampoPergunta(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePergunta() {
		if( $this -> idPergunta ){
				
			return $this -> updateCampoPergunta(
				array(		
					"tipoPergunta_id" => $this -> tipoPergunta_idPergunta, 		
					"pergunta_id" => $this -> pergunta_idPergunta, 		
					"empresa_id" => $this -> empresa_idPergunta, 		
					"idioma_id" => $this -> idioma_idPergunta, 		
					"nivelPergunta_id" => $this -> nivelPergunta_idPergunta, 		
					"categoriaPergunta_id" => $this -> categoriaPergunta_idPergunta, 		
					"titulo" => $this -> tituloPergunta, 		
					"enunciado" => $this -> enunciadoPergunta, 		
					"tempoResposta" => $this -> tempoRespostaPergunta, 		
					"inativo" => $this -> inativoPergunta				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPergunta($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPergunta && is_array($sets) ){
			$sql = "UPDATE pergunta SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPergunta;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPergunta($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM pergunta AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
