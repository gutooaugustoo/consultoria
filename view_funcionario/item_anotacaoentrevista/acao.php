<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Item_anotacaoentrevista = new Item_anotacaoentrevista();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idItem_anotacaoentrevista = $_REQUEST['id'];
	
	$rs = $Item_anotacaoentrevista -> deletarItem_anotacaoentrevista($idItem_anotacaoentrevista);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idItem_anotacaoentrevista = $_REQUEST['idItem_anotacaoentrevista'];
	
	$rs = $Item_anotacaoentrevista -> cadastrarItem_anotacaoentrevista($idItem_anotacaoentrevista, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

