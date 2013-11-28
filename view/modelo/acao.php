<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Modelo = new Modelo();

$id = $_REQUEST['id'];

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){

	$res = $Modelo->deletar($id);
	
	if( $res[0] === true ){
		
		$arrayRetorno['fecharNivel'] = true;
		
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}else{
		//
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
	
	$res = $Modelo->cadastrar($id, $_POST);

	if( $res[0] == true ){
		$arrayRetorno['fecharNivel'] = true;			
	}else{
		//
	}
	
}

$arrayRetorno['mensagem'] = $res[1];

echo json_encode($arrayRetorno);

