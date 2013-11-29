<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Pais = new Pais();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idPais = $_REQUEST['id'];
	
	$rs = $Pais -> deletarPais($idPais);
	
	if( $rs[0] != false ){
					
		$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idPais = $_REQUEST['idPais'];
	
	$rs = $Pais -> cadastrarPais($idPais, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

