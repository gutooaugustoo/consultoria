<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_oral = new Candidato_oral();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idCandidato_oral = $_REQUEST['id'];
	
	$rs = $Candidato_oral -> deletarCandidato_oral($idCandidato_oral);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idCandidato_oral = $_REQUEST['idCandidato_oral'];
	
	$rs = $Candidato_oral -> cadastrarCandidato_oral($idCandidato_oral, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

