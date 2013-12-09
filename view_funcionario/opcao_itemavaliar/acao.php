<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Opcao_itemavaliar = new Opcao_itemavaliar();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idOpcao_itemavaliar = $_REQUEST['id'];
	
	$rs = $Opcao_itemavaliar -> deletarOpcao_itemavaliar($idOpcao_itemavaliar);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idOpcao_itemavaliar = $_REQUEST['idOpcao_itemavaliar'];
	
	$rs = $Opcao_itemavaliar -> cadastrarOpcao_itemavaliar($idOpcao_itemavaliar, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

