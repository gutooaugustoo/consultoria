<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico_gestor = new Servico_gestor();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idServico_gestor = $_REQUEST['id'];
	
	$rs = $Servico_gestor -> deletarServico_gestor($idServico_gestor);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idServico_gestor = $_REQUEST['idServico_gestor'];
	
	$rs = $Servico_gestor -> cadastrarServico_gestor($idServico_gestor, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

