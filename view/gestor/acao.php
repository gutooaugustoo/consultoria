<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Gestor = new Gestor();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idGestor = $_REQUEST['id'];
	
	$rs = $Gestor -> deletarGestor($idGestor);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idGestor = $_REQUEST['idGestor'];
	
	$rs = $Gestor -> cadastrarGestor($idGestor, $_POST);

	if( $rs[0] != false ){			
		//$arrayRetorno['atualizarNivelAtual'] = true;
		//$arrayRetorno['pagina'] = CAM_VIEW."gestor/abas.php?idGestor=".$rs[0];
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

