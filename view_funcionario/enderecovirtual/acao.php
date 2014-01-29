<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Enderecovirtual = new Enderecovirtual();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEnderecovirtual = $_REQUEST['id'];
	
	$rs = $Enderecovirtual -> deletarEnderecovirtual($idEnderecovirtual);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEnderecovirtual = $_REQUEST['idEnderecovirtual'];
	
	$rs = $Enderecovirtual -> cadastrarEnderecovirtual($idEnderecovirtual, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

