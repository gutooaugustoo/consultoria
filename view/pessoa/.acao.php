<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Pessoa = new Pessoa();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idPessoa = $_REQUEST['id'];
	
	$rs = $Pessoa -> deletarPessoa($idPessoa);
	
	if( $rs[0] != false ){
					
		$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idPessoa = $_REQUEST['idPessoa'];
	
	$rs = $Pessoa -> cadastrarPessoa($idPessoa, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

