<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Idioma = new Idioma();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idIdioma = $_REQUEST['id'];
	
	$rs = $Idioma -> deletarIdioma($idIdioma);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idIdioma = $_REQUEST['idIdioma'];
	
	$rs = $Idioma -> cadastrarIdioma($idIdioma, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

