<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Temaredacao = new Temaredacao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTemaredacao = $_REQUEST['id'];
	
	$rs = $Temaredacao -> deletarTemaredacao($idTemaredacao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTemaredacao = $_REQUEST['idTemaredacao'];
	
	$rs = $Temaredacao -> cadastrarTemaredacao($idTemaredacao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

