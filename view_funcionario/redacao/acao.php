<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Redacao = new Redacao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idRedacao = $_REQUEST['id'];
	
	$rs = $Redacao -> deletarRedacao($idRedacao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idRedacao = $_REQUEST['idRedacao'];
	
	$rs = $Redacao -> cadastrarRedacao($idRedacao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['atualizarNivelAtual'] = true;
    if( !$idRedacao ) $idRedacao = $rs[0];
    $arrayRetorno['pagina'] = CAM_VIEW."redacao/abas.php?idRedacao=".$idRedacao;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

