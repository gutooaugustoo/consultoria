<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Empresa = new Empresa();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEmpresa = $_REQUEST['id'];
	
	$rs = $Empresa -> deletarEmpresa($idEmpresa);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEmpresa = $_REQUEST['idEmpresa'];
	
	$rs = $Empresa -> cadastrarEmpresa($idEmpresa, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

