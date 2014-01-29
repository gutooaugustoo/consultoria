<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Escola = new Escola();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEscola = $_REQUEST['id'];
	
	$rs = $Escola -> deletarEscola($idEscola);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEscola = $_REQUEST['idEscola'];
	
	$rs = $Escola -> cadastrarEscola($idEscola, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

