<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Teste = new Teste();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTeste = $_REQUEST['id'];
	
	$res = $Teste->deletarTeste($idTeste);
	
	if( $res[0] === true ){
		
		$arrayRetorno['fecharNivel'] = true;
		
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}else{
		//
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTeste = $_REQUEST['idTeste'];
	
	$res = $Teste->cadastrarTeste($idTeste, $_POST);

	if( $res[0] != false){
		$arrayRetorno['fecharNivel'] = true;			
	}else{
		//
	}
	
}

$arrayRetorno['mensagem'] = $res[1];

echo json_encode($arrayRetorno);

