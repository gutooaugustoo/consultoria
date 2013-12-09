<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Dicasentrevista = new Dicasentrevista();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idDicasentrevista = $_REQUEST['id'];
	
	$rs = $Dicasentrevista -> deletarDicasentrevista($idDicasentrevista);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idDicasentrevista = $_REQUEST['idDicasentrevista'];
	
	$rs = $Dicasentrevista -> cadastrarDicasentrevista($idDicasentrevista, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

