<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Itemavaliaroral = new Itemavaliaroral();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idItemavaliaroral = $_REQUEST['id'];
	
	$rs = $Itemavaliaroral -> deletarItemavaliaroral($idItemavaliaroral);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idItemavaliaroral = $_REQUEST['idItemavaliaroral'];
	
	$rs = $Itemavaliaroral -> cadastrarItemavaliaroral($idItemavaliaroral, $_POST);

	if( $rs[0] != false ){			
		//$arrayRetorno['fecharNivel'] = true;
		$arrayRetorno['atualizarNivelAtual'] = true;
		if( !$idItemavaliaroral ) $idItemavaliaroral = $rs[0];
		$arrayRetorno['pagina'] = CAM_VIEW."itemavaliaroral/abas.php?idItemavaliaroral=".$idItemavaliaroral;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

