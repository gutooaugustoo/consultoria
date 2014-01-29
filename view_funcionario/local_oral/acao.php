<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Local_oral = new Local_oral();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idLocal_oral = $_REQUEST['id'];
	
	$rs = $Local_oral -> deletarLocal_oral($idLocal_oral);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idLocal_oral = $_REQUEST['idLocal_oral'];
	
	$rs = $Local_oral -> cadastrarLocal_oral($idLocal_oral, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

