<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Oral_itemavaliar = new Oral_itemavaliar();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idOral_itemavaliar = $_REQUEST['id'];
	
	$rs = $Oral_itemavaliar -> deletarOral_itemavaliar($idOral_itemavaliar);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idOral_itemavaliar = $_REQUEST['idOral_itemavaliar'];
	
	$rs = $Oral_itemavaliar -> cadastrarOral_itemavaliar($idOral_itemavaliar, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

