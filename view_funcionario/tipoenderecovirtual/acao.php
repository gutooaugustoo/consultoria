<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Tipoenderecovirtual = new Tipoenderecovirtual();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTipoenderecovirtual = $_REQUEST['id'];
	
	$rs = $Tipoenderecovirtual -> deletarTipoenderecovirtual($idTipoenderecovirtual);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTipoenderecovirtual = $_REQUEST['idTipoenderecovirtual'];
	
	$rs = $Tipoenderecovirtual -> cadastrarTipoenderecovirtual($idTipoenderecovirtual, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

