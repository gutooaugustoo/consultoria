<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Resp_alternativacorreta = new Resp_alternativacorreta();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idResp_alternativacorreta = $_REQUEST['id'];
	
	$rs = $Resp_alternativacorreta -> deletarResp_alternativacorreta($idResp_alternativacorreta);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idResp_alternativacorreta = $_REQUEST['idResp_alternativacorreta'];
	
	$rs = $Resp_alternativacorreta -> cadastrarResp_alternativacorreta($idResp_alternativacorreta, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

