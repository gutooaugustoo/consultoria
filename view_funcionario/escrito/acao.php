<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Escrito = new Escrito();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEscrito = $_REQUEST['id'];
	
	$rs = $Escrito -> deletarEscrito($idEscrito);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEscrito = $_REQUEST['idEscrito'];
	
	$rs = $Escrito -> cadastrarEscrito($idEscrito, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['atualizarNivelAtual'] = true;
    if( !$idEscrito ) $idEscrito = $rs[0];
    $arrayRetorno['pagina'] = CAM_VIEW."escrito/abas.php?idEscrito=".$idEscrito;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

