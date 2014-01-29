<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Candidato_escrito = new Candidato_escrito();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idCandidato_escrito = $_REQUEST['id'];
	
	$rs = $Candidato_escrito -> deletarCandidato_escrito($idCandidato_escrito);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idCandidato_escrito = $_REQUEST['idCandidato_escrito'];
	
	$rs = $Candidato_escrito -> cadastrarCandidato_escrito($idCandidato_escrito, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

