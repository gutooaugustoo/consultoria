<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_precadastro = new Candidato_precadastro();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idCandidato_precadastro = $_REQUEST['id'];
	
	$rs = $Candidato_precadastro -> deletarCandidato_precadastro($idCandidato_precadastro);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idCandidato_precadastro = $_REQUEST['idCandidato_precadastro'];
	
	$rs = $Candidato_precadastro -> cadastrarCandidato_precadastro($idCandidato_precadastro, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

