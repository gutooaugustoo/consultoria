<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Descricaotelefone = new Descricaotelefone();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idDescricaotelefone = $_REQUEST['id'];
	
	$rs = $Descricaotelefone -> deletarDescricaotelefone($idDescricaotelefone);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idDescricaotelefone = $_REQUEST['idDescricaotelefone'];
	
	$rs = $Descricaotelefone -> cadastrarDescricaotelefone($idDescricaotelefone, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

