<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Areaatencao = new Areaatencao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idAreaatencao = $_REQUEST['id'];
	
	$rs = $Areaatencao -> deletarAreaatencao($idAreaatencao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idAreaatencao = $_REQUEST['idAreaatencao'];
	
	$rs = $Areaatencao -> cadastrarAreaatencao($idAreaatencao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

