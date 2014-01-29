<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Categoriapergunta = new Categoriapergunta();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idCategoriapergunta = $_REQUEST['id'];
	
	$rs = $Categoriapergunta -> deletarCategoriapergunta($idCategoriapergunta);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idCategoriapergunta = $_REQUEST['idCategoriapergunta'];
	
	$rs = $Categoriapergunta -> cadastrarCategoriapergunta($idCategoriapergunta, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

