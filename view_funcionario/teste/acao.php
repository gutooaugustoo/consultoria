<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Teste = new Teste();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTeste = $_REQUEST['id'];
	
	$rs = $Teste -> deletarTeste($idTeste);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTeste = $_REQUEST['idTeste'];
	
	$rs = $Teste -> cadastrarTeste($idTeste, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

