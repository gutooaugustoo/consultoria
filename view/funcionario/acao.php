<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Funcionario = new Funcionario();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idFuncionario = $_REQUEST['id'];
	
	$rs = $Funcionario -> deletarFuncionario($idFuncionario);
	
	if( $rs[0] != false ){
					
		$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idFuncionario = $_REQUEST['idFuncionario'];
	
	$rs = $Funcionario -> cadastrarFuncionario($idFuncionario, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

