<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Oral = new Oral();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idOral = $_REQUEST['id'];
	
	$rs = $Oral -> deletarOral($idOral);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idOral = $_REQUEST['idOral'];
	
	$rs = $Oral -> cadastrarOral($idOral, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['atualizarNivelAtual'] = true;
    if( !$idOral ) $idOral = $rs[0];
    $arrayRetorno['pagina'] = CAM_VIEW."oral/abas.php?idOral=".$idOral;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

