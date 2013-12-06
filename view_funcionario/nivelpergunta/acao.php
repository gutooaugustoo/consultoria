<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Nivelpergunta = new Nivelpergunta();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idNivelpergunta = $_REQUEST['id'];
	
	$rs = $Nivelpergunta -> deletarNivelpergunta($idNivelpergunta);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idNivelpergunta = $_REQUEST['idNivelpergunta'];
	
	$rs = $Nivelpergunta -> cadastrarNivelpergunta($idNivelpergunta, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

