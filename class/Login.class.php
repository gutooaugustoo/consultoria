<?php
class Login extends Database {
		
	// constructor
	function __construct() {
		parent::__construct();		
	}
	
	function __destruct(){
		parent::__destruct();
	}
	
	function efetuarLogin($documentoUnico, $senhaAcesso) {
			
		$Funcionario = new Funcionario();
		$where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = ".Uteis::escapeRequest($documentoUnico)." AND P.senha = ".Uteis::escapeRequest($senhaAcesso);
		$rs = $Funcionario->selectFuncionario($where, array("F.id"));		
		//Uteis::pr($rs, 1);
		if( $rs = $rs[0] ){																
			$this->efetuarLogoff(false);				
			$_SESSION['logado'] = true;
			$_SESSION['idFuncionario'] = $rs['id'];																			
			header("Location:".CAM_ROOT."/admin/");			
			return true;
		}
		
		return false;
				       
	}
	
	function efetuarLogoff($redireciona = true) {
		
		//GERAL
		$_SESSION['logado'] = false;				
		
		//ADMIN
		$_SESSION['idFuncionario'] = "";
		//CANDIDATO
		//GESTOR
		//AVALIADOR		
		if( $redireciona == true ){
			session_destroy();
			header("Location:".CAM_ROOT."/admin/");
		}
		
	}
	
	function verificarLogin() {
		if( $_SESSION['logado'] && $_SESSION['idFuncionario'] ){
			return true;
		}else{			
			return false;
		}
	}
		
}?>