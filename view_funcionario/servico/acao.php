<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

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
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

