<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Itemavaliarredacao = new Itemavaliarredacao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idItemavaliarredacao = $_REQUEST['id'];
	
	$rs = $Itemavaliarredacao -> deletarItemavaliarredacao($idItemavaliarredacao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idItemavaliarredacao = $_REQUEST['idItemavaliarredacao'];
	
	$rs = $Itemavaliarredacao -> cadastrarItemavaliarredacao($idItemavaliarredacao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

