<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Redacao_itemavaliar = new Redacao_itemavaliar();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idRedacao_itemavaliar = $_REQUEST['id'];
	
	$rs = $Redacao_itemavaliar -> deletarRedacao_itemavaliar($idRedacao_itemavaliar);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idRedacao_itemavaliar = $_REQUEST['idRedacao_itemavaliar'];
	
	$rs = $Redacao_itemavaliar -> cadastrarRedacao_itemavaliar($idRedacao_itemavaliar, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

