<?php
class Login extends Database {
		
	// constructor
	function __construct() {
		parent::__construct();		
	}
	
	function __destruct(){
		parent::__destruct();
	}
	
	function efetuarLogin_adm($documentoUnico, $senhaAcesso){
		$Funcionario = new Funcionario();
		$where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = ".Uteis::escapeRequest($documentoUnico)." AND P.senha = ".Uteis::escapeRequest($senhaAcesso);
		$rs = $Funcionario->selectFuncionario($where, array("F.id"));
		//Uteis::pr($rs, 1);
		if( $rs ) $this->efetuarLogin($rs[0]['id'], "funcionario"); 
		return false;
	}
	
	function efetuarLogin_candidato($documentoUnico, $senhaAcesso){
		$Candidato = new Candidato();
		$where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = ".Uteis::escapeRequest($documentoUnico)." AND P.senha = ".Uteis::escapeRequest($senhaAcesso);
		$rs = $Candidato->selectCandidato($where, array("C.id"));
		//Uteis::pr($rs, 1);
		if( $rs ) $this->efetuarLogin($rs[0]['id'], "candidato"); 
		return false;
	}
	
	function efetuarLogin_gestor($documentoUnico, $senhaAcesso){
		$Gestor = new Gestor();
		$where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = ".Uteis::escapeRequest($documentoUnico)." AND P.senha = ".Uteis::escapeRequest($senhaAcesso);
		$rs = $Gestor->selectGestor($where, array("G.id"));
		//Uteis::pr($rs, 1);
		if( $rs ) $this->efetuarLogin($rs[0]['id'], "gestor"); 
		return false;
	}
	
	function efetuarLogin_avaliador($documentoUnico, $senhaAcesso){
		$Avaliador = new Avaliador();
		$where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = ".Uteis::escapeRequest($documentoUnico)." AND P.senha = ".Uteis::escapeRequest($senhaAcesso);
		$rs = $Avaliador->selectAvaliador($where, array("A.id"));
		//Uteis::pr($rs, 1);
		if( $rs ) $this->efetuarLogin($rs[0]['id'], "avaliador"); 
		return false;
	}
	
	function efetuarLogin($id, $session) {
																		
		$this->efetuarLogoff(false);				
		
		$_SESSION['logado'] = $session;
		$_SESSION['id'.ucfirst($session)] = $id;
																	
		header("Location:".CAM_ROOT."/");			
		return true;
						       
	}
	
	function efetuarLogoff($redireciona = true) {
		
		//GERAL
		$_SESSION['logado'] = false;				
		
		//ADMIN
		$_SESSION['idFuncionario'] = "";
		//CANDIDATO
		$_SESSION['idCandidato'] = "";
		//GESTOR
		$_SESSION['idGestor'] = "";
		//AVALIADOR
		$_SESSION['idAvaliador'] = "";
				
		if( $redireciona == true ){
			session_destroy();
			header("Location:".CAM_ROOT."/");
		}
		
	}
	
	function verificarLogin() {
		if( $_SESSION['logado'] && $_SESSION['id'.ucfirst($_SESSION['logado'])] ){
			return true;
		}else{			
			return false;
		}
	}
		
}?>