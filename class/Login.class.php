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
			
		$f = new Funcionario();
		$f->select();
		$sql = "";
		$rs = $this->query($sql);
		
		if($result = mysql_fetch_array($rs)){			
			if( $result['documentoUnico'] == $documentoUnico && $result['senhaAcesso'] == $senhaAcesso ){											
				$this->efetuarLogoff(false);				
				$_SESSION['logado'] = true;
				$_SESSION['idFuncionario'] = $result['idFuncionario'];				
				header('Location:/consultoria/admin/index.php');
				return true;			
			}
		}
		
		return false;
				       
	}
	
	function efetuarLogoff($redireciona = true) {
		
		//GERAL
		$_SESSION['logado'] = false;				
		
		//ADMIN
		$_SESSION['idFuncionario'] = "";		
		
		if( $redireciona == true ){
			session_destroy();
			header('Location:/');
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