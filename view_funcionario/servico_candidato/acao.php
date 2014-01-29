<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico_candidato = new Servico_candidato();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idServico_candidato = $_REQUEST['id'];
	
	$rs = $Servico_candidato -> deletarServico_candidato($idServico_candidato);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idServico_candidato = $_REQUEST['idServico_candidato'];
	
	$rs = $Servico_candidato -> cadastrarServico_candidato($idServico_candidato, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

