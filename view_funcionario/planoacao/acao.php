<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Planoacao = new Planoacao();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idPlanoacao = $_REQUEST['id'];
	
	$rs = $Planoacao -> deletarPlanoacao($idPlanoacao);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idPlanoacao = $_REQUEST['idPlanoacao'];
	
	$rs = $Planoacao -> cadastrarPlanoacao($idPlanoacao, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

