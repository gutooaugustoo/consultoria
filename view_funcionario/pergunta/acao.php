<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

$arrayRetorno = array();

if ($_REQUEST['acao'] == "deletar") {

	$idPergunta = $_REQUEST['id'];

	$rs = $Pergunta -> deletarPergunta($idPergunta);

	if ($rs[0] != false) {

		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];

	}

} elseif ($_REQUEST['acao'] == "cadastrar") {

	$idPergunta = $_REQUEST['idPergunta'];

	$rs = $Pergunta -> cadastrarPergunta($idPergunta, $_POST);

	if ($rs[0] != false) {
		$arrayRetorno['atualizarNivelAtual'] = true;
		if (!$idPergunta)
			$idPergunta = $rs[0];
		$arrayRetorno['pagina'] = CAM_VIEW . "pergunta/abas.php?idPergunta=" . $idPergunta;
	}

}

$arrayRetorno['mensagem'] = $rs[1];

echo json_encode($arrayRetorno);
