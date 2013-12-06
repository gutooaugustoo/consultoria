<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Backgroundidioma = new Backgroundidioma();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idBackgroundidioma = $_REQUEST['id'];
	
	$rs = $Backgroundidioma -> deletarBackgroundidioma($idBackgroundidioma);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idBackgroundidioma = $_REQUEST['idBackgroundidioma'];
	
	$rs = $Backgroundidioma -> cadastrarBackgroundidioma($idBackgroundidioma, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

