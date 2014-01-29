<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Escrito_pergunta = new Escrito_pergunta();

$arrayRetorno = array();

if( $_REQUEST['acao'] == "deletar" ){
		
	$idEscrito_pergunta = $_REQUEST['id'];
	
	$rs = $Escrito_pergunta -> deletarEscrito_pergunta($idEscrito_pergunta);
	
	if( $rs[0] != false ){
							
		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];	
		
	}
	
}elseif( $_REQUEST['acao'] == "cadastrar" ){
		
	$idEscrito_pergunta = $_REQUEST['idEscrito_pergunta'];
	
	$rs = $Escrito_pergunta -> cadastrarEscrito_pergunta($idEscrito_pergunta, $_POST);

	if( $rs[0] != false ){			
		$arrayRetorno['fecharNivel'] = true;
	}
	
}elseif( $_REQUEST['acao'] == "getComplemento" ){
                
   $Pergunta = new Pergunta($_POST['id']);      
   $arrayRetorno['valor2'][] = $Pergunta->get_enunciadoPergunta();
   $arrayRetorno['elementoAtualizar'][] = $_POST['onde'];     
   echo json_encode($arrayRetorno);   
   exit; 
   
}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);

