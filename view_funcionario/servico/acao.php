<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico = new Servico();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idServico = $_REQUEST['id'];
	
	$rs = $Servico -> deletarServico($idServico);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idServico = $_REQUEST['idServico'];
	
	$rs = $Servico -> cadastrarServico($idServico, $_POST);

	if( $rs[0] != false ){					
		$arrayRetorno['atualizarNivelAtual'] = true;
		if( !$idServico ) $idServico = $rs[0];
		$arrayRetorno['pagina'] = CAM_VIEW."servico/abas.php?idServico=".$idServico;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

