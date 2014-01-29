<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Redacao_temaredacao = new Redacao_temaredacao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idRedacao_temaredacao = $_REQUEST['id'];
	
	$rs = $Redacao_temaredacao -> deletarRedacao_temaredacao($idRedacao_temaredacao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idRedacao_temaredacao = $_REQUEST['idRedacao_temaredacao'];
	
	$rs = $Redacao_temaredacao -> cadastrarRedacao_temaredacao($idRedacao_temaredacao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

