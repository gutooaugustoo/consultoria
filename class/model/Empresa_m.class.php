<?php
class Empresa_m extends Database { 
	
	// ATRIBUTOS
	protected $idEmpresa;
	protected $razaoSocialEmpresa;
	protected $nomeFantasiaEmpresa;
	protected $cnpjEmpresa;
	protected $logoEmpresa;
	protected $ieEmpresa;
	protected $inativoEmpresa = 0;
	
	//CONSTRUTOR
	function __construct( $idEmpresa = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEmpresa) ){
		
			$array = $this -> selectEmpresa(" WHERE E.id = ".$this -> gravarBD($idEmpresa) );			
			
			$this -> idEmpresa = $array[0]['id'];
			$this -> razaoSocialEmpresa = $array[0]['razaoSocial'];
			$this -> nomeFantasiaEmpresa = $array[0]['nomeFantasia'];
			$this -> cnpjEmpresa = $array[0]['cnpj'];
			$this -> logoEmpresa = $array[0]['logo'];
			$this -> ieEmpresa = $array[0]['ie'];
			$this -> inativoEmpresa = $array[0]['inativo'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEmpresa($valor) {
		$this -> idEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_razaoSocialEmpresa($valor) {
		$this -> razaoSocialEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeFantasiaEmpresa($valor) {
		$this -> nomeFantasiaEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_cnpjEmpresa($valor) {
		$this -> cnpjEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_logoEmpresa($valor) {
		$this -> logoEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_ieEmpresa($valor) {
		$this -> ieEmpresa = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_inativoEmpresa($valor) {
		$this -> inativoEmpresa = ($valor) ? $this -> gravarBD($valor) : "0";
		return $this;
	}
		
	//GETS
	
	function get_idEmpresa() {
		return ($this -> idEmpresa);
	}
	
	function get_razaoSocialEmpresa() {
		return ($this -> razaoSocialEmpresa);
	}
	
	function get_nomeFantasiaEmpresa() {
		return ($this -> nomeFantasiaEmpresa);
	}
	
	function get_cnpjEmpresa() {
		return ($this -> cnpjEmpresa);
	}
	
	function get_logoEmpresa() {
		return ($this -> logoEmpresa);
	}
	
	function get_ieEmpresa() {
		return ($this -> ieEmpresa);
	}
	
	function get_inativoEmpresa($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> inativoEmpresa : Uteis::exibirStatus($this -> inativoEmpresa);
	}
				
	//MANUSEANDO O BANCO
		
	function insertEmpresa() {
		$sql = "INSERT INTO empresa 
		(razaoSocial, nomeFantasia, cnpj, logo, ie, inativo) 
		VALUES (	
			" . $this -> razaoSocialEmpresa . ", 	
			" . $this -> nomeFantasiaEmpresa . ", 	
			" . $this -> cnpjEmpresa . ", 	
			" . $this -> logoEmpresa . ", 	
			" . $this -> ieEmpresa . ", 	
			" . $this -> inativoEmpresa . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEmpresa() {
		return $this -> updateCampoEmpresa(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEmpresa() {
		if( $this -> idEmpresa ){
				
			return $this -> updateCampoEmpresa(
				array(		
					"razaoSocial" => $this -> razaoSocialEmpresa, 		
					"nomeFantasia" => $this -> nomeFantasiaEmpresa, 		
					"cnpj" => $this -> cnpjEmpresa, 		
					"logo" => $this -> logoEmpresa, 		
					"ie" => $this -> ieEmpresa, 		
					"inativo" => $this -> inativoEmpresa				
				), MSG_CADUP	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEmpresa($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEmpresa && is_array($sets) ){
			$sql = "UPDATE empresa SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEmpresa;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEmpresa($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM empresa AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
