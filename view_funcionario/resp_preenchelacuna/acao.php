<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Resp_preenchelacuna = new Resp_preenchelacuna();

$arrayRetorno = array();

if ($_REQUEST['acao'] == "deletar") {

	$idResp_preenchelacuna = $_REQUEST['id'];

	$rs = $Resp_preenchelacuna -> deletarResp_preenchelacuna($idResp_preenchelacuna);

	if ($rs[0] != false) {

		$arrayRetorno['tabela'] = $_REQUEST['tabela'];
		$arrayRetorno['ordem'] = $_REQUEST['ordem'];

	}
	$arrayRetorno['mensagem'] = $rs[1];

} elseif ($_REQUEST['acao'] == "cadastrar") {

	$idResp_preenchelacuna = $_REQUEST['idResp_preenchelacuna'];

	$rs = $Resp_preenchelacuna -> cadastrarResp_preenchelacuna($idResp_preenchelacuna, $_POST);
	
	if ($rs[0] != false) {
		$arrayRetorno['fecharNivel'] = true;
	}
	$arrayRetorno['mensagem'] = $rs[1];

}

echo json_encode($arrayRetorno);
