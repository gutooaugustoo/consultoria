<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Avaliador = new Avaliador();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idAvaliador = $_REQUEST['id'];
	
	$rs = $Avaliador -> deletarAvaliador($idAvaliador);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idAvaliador = $_REQUEST['idAvaliador'];
	
	$rs = $Avaliador -> cadastrarAvaliador($idAvaliador, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = CAM_VIEW."avaliador/abas.php?idAvaliador=".$rs[0];
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

