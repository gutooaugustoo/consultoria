<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Resp_verdadeirofalso = new Resp_verdadeirofalso();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idResp_verdadeirofalso = $_REQUEST['id'];
	
	$rs = $Resp_verdadeirofalso -> deletarResp_verdadeirofalso($idResp_verdadeirofalso);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idResp_verdadeirofalso = $_REQUEST['idResp_verdadeirofalso'];
	
	$rs = $Resp_verdadeirofalso -> cadastrarResp_verdadeirofalso($idResp_verdadeirofalso, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

