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

/*} elseif ($_REQUEST['acao'] == "gerarLacuna") {
	
	$pergunta_id = $_REQUEST['pergunta_id'];

	if ( $pergunta_id ) {
		
		$enunciado = $_REQUEST['enunciado'];		
		$pattern = "/#_#/";
		//$enunciado = preg_replace($pattern, "#__#", $enunciado, -1, $cont);
		//echo "$cont";exit;
		$Pergunta = new Pergunta();
		$Pergunta -> set_idPergunta($pergunta_id);		
		$Pergunta -> updateCampoPergunta(array("enunciado" => Uteis::escapeRequest($enunciado)));
		
		$arrayRetorno['mensagem'] = "Lacunas definidas com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
		
		/*$post = array();
		$post['pergunta_id'] = $pergunta_id;
		$post['lacuna'] = $lacuna;

		$rsOrdem = $Resp_preenchelacuna -> selectResp_preenchelacuna(" WHERE R.pergunta_id = " . Uteis::escapeRequest($pergunta_id) . " ORDER BY R.ordem ASC");
		$ordem = ($rsOrdem ? $rsOrdem[0]['ordem'] : "0") + 1;
		$post['ordem'] = $ordem;

		$rs = $Resp_preenchelacuna -> cadastrarResp_preenchelacuna("", $post);

		if ($rs[0] != false) {
			$arrayRetorno['atualizarNivelAtual'] = true;
			$arrayRetorno['pagina'] = CAM_VIEW . "resp_preenchelacuna/abas_geral.php?pergunta_id=" . $pergunta_id;
		}
		
		$arrayRetorno['mensagem'] = $rs[1];

	}*/

}

echo json_encode($arrayRetorno);
