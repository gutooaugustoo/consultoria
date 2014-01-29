<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Oral_dicas = new Oral_dicas();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idOral_dicas = $_REQUEST['id'];
	
	$rs = $Oral_dicas -> deletarOral_dicas($idOral_dicas);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idOral_dicas = $_REQUEST['idOral_dicas'];
	
	$rs = $Oral_dicas -> cadastrarOral_dicas($idOral_dicas, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

