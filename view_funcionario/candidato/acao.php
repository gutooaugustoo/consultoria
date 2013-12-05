<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato = new Candidato();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idCandidato = $_REQUEST['id'];
	
	$rs = $Candidato -> deletarCandidato($idCandidato);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idCandidato = $_REQUEST['idCandidato'];
	
	$rs = $Candidato -> cadastrarCandidato($idCandidato, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = CAM_VIEW."candidato/abas.php?idCandidato=".$rs[0];
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

