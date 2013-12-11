<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico_avaliador = new Servico_avaliador();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idServico_avaliador = $_REQUEST['id'];
	
	$rs = $Servico_avaliador -> deletarServico_avaliador($idServico_avaliador);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idServico_avaliador = $_REQUEST['idServico_avaliador'];
	
	$rs = $Servico_avaliador -> cadastrarServico_avaliador($idServico_avaliador, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

