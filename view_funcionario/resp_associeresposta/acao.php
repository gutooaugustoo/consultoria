<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Resp_associeresposta = new Resp_associeresposta();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idResp_associeresposta = $_REQUEST['id'];
	
	$rs = $Resp_associeresposta -> deletarResp_associeresposta($idResp_associeresposta);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idResp_associeresposta = $_REQUEST['idResp_associeresposta'];
	
	$rs = $Resp_associeresposta -> cadastrarResp_associeresposta($idResp_associeresposta, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

