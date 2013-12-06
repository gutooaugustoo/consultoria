<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Tipoescrito = new Tipoescrito();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTipoescrito = $_REQUEST['id'];
	
	$rs = $Tipoescrito -> deletarTipoescrito($idTipoescrito);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTipoescrito = $_REQUEST['idTipoescrito'];
	
	$rs = $Tipoescrito -> cadastrarTipoescrito($idTipoescrito, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

