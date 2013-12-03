<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Telefone = new Telefone();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTelefone = $_REQUEST['id'];
	
	$rs = $Telefone -> deletarTelefone($idTelefone);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTelefone = $_REQUEST['idTelefone'];
	
	$rs = $Telefone -> cadastrarTelefone($idTelefone, $_POST);
	
	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

