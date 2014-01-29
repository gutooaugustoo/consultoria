<?php
class Pessoa_m extends Database { 
	
	// ATRIBUTOS
	protected $idPessoa;
	protected $pais_idPessoa = ID_PAIS;
	protected $tipoDocumentoUnico_idPessoa = 1;
	protected $estadoCivil_idPessoa;
	protected $nomePessoa;
	protected $emailPrincipalPessoa;
	protected $dataNascimentoPessoa;
	protected $rgPessoa;
	protected $fotoPessoa;
	protected $curriculumPessoa;
	protected $cargoPessoa;
	protected $sexoPessoa;
	protected $senhaPessoa;
	protected $documentoPessoa;
	protected $inativoPessoa = 0;
	protected $obsPessoa;
	
	//CONSTRUTOR
	function __construct( $idPessoa = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPessoa) ){
		
			$array = $this -> selectPessoa(" WHERE P.id = ".$this -> gravarBD($idPessoa) );			
			
			$this -> idPessoa = $array[0]['id'];
			$this -> pais_idPessoa = $array[0]['pais_id'];
			$this -> tipoDocumentoUnico_idPessoa = $array[0]['tipoDocumentoUnico_id'];
			$this -> estadoCivil_idPessoa = $array[0]['estadoCivil_id'];
			$this -> nomePessoa = $array[0]['nome'];
			$this -> emailPrincipalPessoa = $array[0]['emailPrincipal'];
			$this -> dataNascimentoPessoa = $array[0]['dataNascimento'];
			$this -> rgPessoa = $array[0]['rg'];
			$this -> fotoPessoa = $array[0]['foto'];
			$this -> curriculumPessoa = $array[0]['curriculum'];
			$this -> cargoPessoa = $array[0]['cargo'];
			$this -> sexoPessoa = $array[0]['sexo'];
			$this -> senhaPessoa = $array[0]['senha'];
			$this -> documentoPessoa = $array[0]['documento'];
			$this -> inativoPessoa = $array[0]['inativo'];
			$this -> obsPessoa = $array[0]['obs'];
			
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
	
	function set_emailPrincipalPessoa($valor) {
		$this -> emailPrincipalPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_dataNascimentoPessoa($valor) {
		$this -> dataNascimentoPessoa = ($valor) ? $this -> gravarBD(Uteis::gravarData($valor)) : "NULL";
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
	
	function set_obsPessoa($valor) {
		$this -> obsPessoa = ($valor) ? $this -> gravarBD($valor) : "NULL";
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
	
	function get_emailPrincipalPessoa() {
		return ($this -> emailPrincipalPessoa);
	}
	
	function get_dataNascimentoPessoa() {
		if( $this -> dataNascimentoPessoa ) return Uteis::exibirData($this -> dataNascimentoPessoa);
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
		return !$mostrarImagem ? $this -> inativoPessoa : Uteis::exibirStatus(!$this -> inativoPessoa);
	}
	
	function get_obsPessoa() {
		return ($this -> obsPessoa);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPessoa() {
		$sql = "INSERT INTO pessoa 
		(pais_id, tipoDocumentoUnico_id, estadoCivil_id, nome, emailPrincipal, dataNascimento, rg, foto, curriculum, cargo, sexo, senha, documento, inativo, obs) 
		VALUES (	
			" . $this -> pais_idPessoa . ", 	
			" . $this -> tipoDocumentoUnico_idPessoa . ", 	
			" . $this -> estadoCivil_idPessoa . ", 	
			" . $this -> nomePessoa . ", 	
			" . $this -> emailPrincipalPessoa . ", 	
			" . $this -> dataNascimentoPessoa . ", 	
			" . $this -> rgPessoa . ", 	
			" . $this -> fotoPessoa . ", 	
			" . $this -> curriculumPessoa . ", 	
			" . $this -> cargoPessoa . ", 	
			" . $this -> sexoPessoa . ", 	
			" . $this -> senhaPessoa . ", 	
			" . $this -> documentoPessoa . ", 	
			" . $this -> inativoPessoa . ", 	
			" . $this -> obsPessoa . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
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
					"emailPrincipal" => $this -> emailPrincipalPessoa, 		
					"dataNascimento" => $this -> dataNascimentoPessoa, 		
					"rg" => $this -> rgPessoa, 		
					"foto" => $this -> fotoPessoa, 		
					"curriculum" => $this -> curriculumPessoa, 		
					"cargo" => $this -> cargoPessoa, 		
					"sexo" => $this -> sexoPessoa, 		
					"senha" => $this -> senhaPessoa, 		
					"documento" => $this -> documentoPessoa, 		
					"inativo" => $this -> inativoPessoa, 		
					"obs" => $this -> obsPessoa				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPessoa($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPessoa && is_array($sets) ){
			$sql = "UPDATE pessoa SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPessoa;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPessoa($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM pessoa AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
