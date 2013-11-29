<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Estadocivil = new Estadocivil();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEstadocivil = $_REQUEST['id'];
	
	$rs = $Estadocivil -> deletarEstadocivil($idEstadocivil);
	
	if( $rs[0] != false ){
					
		$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEstadocivil = $_REQUEST['idEstadocivil'];
	
	$rs = $Estadocivil -> cadastrarEstadocivil($idEstadocivil, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

