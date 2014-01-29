<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Nivelcandidato = new Nivelcandidato();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idNivelcandidato = $_REQUEST['id'];
	
	$rs = $Nivelcandidato -> deletarNivelcandidato($idNivelcandidato);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idNivelcandidato = $_REQUEST['idNivelcandidato'];
	
	$rs = $Nivelcandidato -> cadastrarNivelcandidato($idNivelcandidato, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

