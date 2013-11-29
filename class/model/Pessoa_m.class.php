<?php
class Pessoa_m extends Database { 
	
	// ATRIBUTOS
	protected $idPessoa;
	protected $pais_idPessoa;
	protected $tipoDocumentoUnico_idPessoa;
	protected $estadoCivil_idPessoa;
	protected $nomePessoa;
	protected $rgPessoa;
	protected $fotoPessoa;
	protected $curriculumPessoa;
	protected $cargoPessoa;
	protected $sexoPessoa;
	protected $senhaPessoa;
	protected $documentoPessoa;
	protected $inativoPessoa = 0;
	
	//CONSTRUTOR
	function __construct( $idPessoa = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPessoa) ){
		
			$array = $this -> selectPessoa(" WHERE id = ".$this -> gravarBD($idPessoa) );			
			
			$this -> idPessoa = $array[0]['id'];
			$this -> pais_idPessoa = $array[0]['pais_id'];
			$this -> tipoDocumentoUnico_idPessoa = $array[0]['tipoDocumentoUnico_id'];
			$this -> estadoCivil_idPessoa = $array[0]['estadoCivil_id'];
			$this -> nomePessoa = $array[0]['nome'];
			$this -> rgPessoa = $array[0]['rg'];
			$this -> fotoPessoa = $array[0]['foto'];
			$this -> curriculumPessoa = $array[0]['curriculum'];
			$this -> cargoPessoa = $array[0]['cargo'];
			$this -> sexoPessoa = $array[0]['sexo'];
			$this -> senhaPessoa = $array[0]['senha'];
			$this -> documentoPessoa = $array[0]['documento'];
			$this -> inativoPessoa = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPessoa($valor) {
		$this -> idPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pais_idPessoa($valor) {
		$this -> pais_idPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tipoDocumentoUnico_idPessoa($valor) {
		$this -> tipoDocumentoUnico_idPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_estadoCivil_idPessoa($valor) {
		$this -> estadoCivil_idPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomePessoa($valor) {
		$this -> nomePessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_rgPessoa($valor) {
		$this -> rgPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_fotoPessoa($valor) {
		$this -> fotoPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_curriculumPessoa($valor) {
		$this -> curriculumPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_cargoPessoa($valor) {
		$this -> cargoPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_sexoPessoa($valor) {
		$this -> sexoPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_senhaPessoa($valor) {
		$this -> senhaPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_documentoPessoa($valor) {
		$this -> documentoPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoPessoa($valor) {
		$this -> inativoPessoa = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idPessoa() {
		return ($this -> idPessoa);
	}
	
	function get_pais_idPessoa() {
		return ($this -> pais_idPessoa);
	}
	
	function get_tipoDocumentoUnico_idPessoa() {
		return ($this -> tipoDocumentoUnico_idPessoa);
	}
	
	function get_estadoCivil_idPessoa() {
		return ($this -> estadoCivil_idPessoa);
	}
	
	function get_nomePessoa() {
		return ($this -> nomePessoa);
	}
	
	function get_rgPessoa() {
		return ($this -> rgPessoa);
	}
	
	function get_fotoPessoa() {
		return ($this -> fotoPessoa);
	}
	
	function get_curriculumPessoa() {
		return ($this -> curriculumPessoa);
	}
	
	function get_cargoPessoa() {
		return ($this -> cargoPessoa);
	}
	
	function get_sexoPessoa() {
		return ($this -> sexoPessoa);
	}
	
	function get_senhaPessoa() {
		return ($this -> senhaPessoa);
	}
	
	function get_documentoPessoa() {
		return ($this -> documentoPessoa);
	}
	
	function get_inativoPessoa($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoPessoa : Uteis::exibirStatus($this -> inativoPessoa);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPessoa() {
		$sql = "INSERT INTO pessoa (pais_id, tipoDocumentoUnico_id, estadoCivil_id, nome, rg, foto, curriculum, cargo, sexo, senha, documento, inativo) 
		VALUES ($this -> pais_idPessoa, $this -> tipoDocumentoUnico_idPessoa, $this -> estadoCivil_idPessoa, $this -> nomePessoa, $this -> rgPessoa, $this -> fotoPessoa, $this -> curriculumPessoa, $this -> cargoPessoa, $this -> sexoPessoa, $this -> senhaPessoa, $this -> documentoPessoa, $this -> inativoPessoa)";
		if( $this -> query($sql) ){
			return mysql_insert_id($this -> connect, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePessoa() {
		return $this -> updateCampoPessoa(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePessoa() {
		if( $this -> idPessoa ){
				
			return $this -> updateCampoPessoa(
				array(		
					"pais_id" => $this -> pais_idPessoa, 		
					"tipoDocumentoUnico_id" => $this -> tipoDocumentoUnico_idPessoa, 		
					"estadoCivil_id" => $this -> estadoCivil_idPessoa, 		
					"nome" => $this -> nomePessoa, 		
					"rg" => $this -> rgPessoa, 		
					"foto" => $this -> fotoPessoa, 		
					"curriculum" => $this -> curriculumPessoa, 		
					"cargo" => $this -> cargoPessoa, 		
					"sexo" => $this -> sexoPessoa, 		
					"senha" => $this -> senhaPessoa, 		
					"documento" => $this -> documentoPessoa, 		
					"inativo" => $this -> inativoPessoa				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPessoa($sets = array(), $msg) {		
		if( $this -> idPessoa && is_array($sets) ){
			$sql = "UPDATE pessoa SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPessoa;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPessoa($where = "", $campos = array("*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM pessoa ".$where;
		return $this -> executarQuery($sql);
	}
		
}
