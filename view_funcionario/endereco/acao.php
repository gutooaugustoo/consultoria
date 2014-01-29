<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Endereco = new Endereco();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEndereco = $_REQUEST['id'];
	
	$rs = $Endereco -> deletarEndereco($idEndereco);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEndereco = $_REQUEST['idEndereco'];
	
	$rs = $Endereco -> cadastrarEndereco($idEndereco, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}elseif( $_REQUEST['acao'] == "carregarCidade" ){
	
	if( $_REQUEST['uf_id'] ){
		echo "<label>Cidade:</label>";
		$Cidade = new Cidade();
		echo $Cidade -> selectCidade_html('cidade_id', $_REQUEST['idCidade'], " WHERE uf_id = ".Uteis::escapeRequest($_REQUEST['uf_id']));	
		echo "<span class=\"placeholder\" ></span>";
	}
	exit;
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

