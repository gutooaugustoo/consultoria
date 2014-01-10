<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta_randomica = new Escrito_pergunta_randomica();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEscrito_pergunta_randomica = $_REQUEST['id'];
	
	$rs = $Escrito_pergunta_randomica -> deletarEscrito_pergunta_randomica($idEscrito_pergunta_randomica);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEscrito_pergunta_randomica = $_REQUEST['idEscrito_pergunta_randomica'];
	
	$rs = $Escrito_pergunta_randomica -> cadastrarEscrito_pergunta_randomica($idEscrito_pergunta_randomica, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

