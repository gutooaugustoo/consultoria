<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Peso_nivel = new Peso_nivel();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idPeso_nivel = $_REQUEST['id'];
	
	$rs = $Peso_nivel -> deletarPeso_nivel($idPeso_nivel);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idPeso_nivel = $_REQUEST['idPeso_nivel'];
	
	$rs = $Peso_nivel -> cadastrarPeso_nivel($idPeso_nivel, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

