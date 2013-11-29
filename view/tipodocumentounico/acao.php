<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Tipodocumentounico = new Tipodocumentounico();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idTipodocumentounico = $_REQUEST['id'];
	
	$rs = $Tipodocumentounico -> deletarTipodocumentounico($idTipodocumentounico);
	
	if( $rs[0] != false ){
					
		$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idTipodocumentounico = $_REQUEST['idTipodocumentounico'];
	
	$rs = $Tipodocumentounico -> cadastrarTipodocumentounico($idTipodocumentounico, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

