<?php
class Resp_preenchelacuna extends Resp_preenchelacuna_m {

	//CONSTRUTOR
	function __construct($idResp_preenchelacuna = "") {
		parent::__construct($idResp_preenchelacuna);
	}

	function __destruct() {
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResp_preenchelacuna_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array(
			"id",
			"lacuna AS legenda"
		);
		$array = $this -> selectResp_preenchelacuna($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}

	function selectMultipleResp_preenchelacuna_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array(
			"id",
			"lacuna AS legenda"
		);
		$array = $this -> selectResp_preenchelacuna($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}

	/*function checkBoxResp_preenchelacuna_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
	 $where .= " AND R.excluido = 0";
	 $campos = array("id", "lacuna AS legenda");
	 $array = $this -> selectResp_preenchelacuna($where, $campos);
	 return Html::selectMultiple($nomeId, $idAtual, $array);
	 }*/

	function tabelaResp_preenchelacuna_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false) {

		$array = $this -> selectResp_preenchelacuna($where, array("R.id"));

		if ($array) {

			$cont = 0;
			$linha = array();

			foreach ($array as $iten) {

				$colunas = array();

				//CARREGAR VALORES
				$this -> __construct($iten['id']);

				$colunas[] = $this -> get_ordemResp_preenchelacuna();
				$colunas[] = $this -> get_lacunaResp_preenchelacuna();

				$ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
				$urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
				$atualizarFinal = $atualizar . $urlAux . "&tr=1&idResp_preenchelacuna=" . $this -> get_idResp_preenchelacuna();

				$editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idResp_preenchelacuna=" . $this -> get_idResp_preenchelacuna() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

				$deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idResp_preenchelacuna() . "', '$atualizarFinal', '$ondeAtualizar')\">";

				if ($apenasLinha !== false) {
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar,
						$deletar
					));
					break;
				} else {
					$colunas[] = array(
						$editar,
						$deletar
					);
					$linhas[] = $colunas;
				}

			}

		}

		return ($apenasLinha !== false) ? $colunas : Html::montarColunas($linhas);

	}

	//AÇÕES
	function cadastrarResp_preenchelacuna($idResp_preenchelacuna, $post = array()) {

		//CARREGAR DO POST
		$pergunta_id = ($post['pergunta_id']);
		if ($pergunta_id == '')
			return array(
				false,
				MSG_OBRIGAT . " Pergunta"
			);

		$ordem = ($post['ordem']);

		$lacuna = ($post['lacuna']);
		if ($lacuna == '')
			return array(
				false,
				MSG_OBRIGAT . " Lacuna"
			);

		//SETAR
		$this -> set_pergunta_idResp_preenchelacuna($pergunta_id) -> set_lacunaResp_preenchelacuna($lacuna);

		if ($idResp_preenchelacuna) {
			$this -> set_idResp_preenchelacuna($idResp_preenchelacuna);
			return ($this -> updateResp_preenchelacuna());
		} else {
			
			$rs = $this -> selectResp_preenchelacuna(" WHERE R.pergunta_id = " . $this -> pergunta_idResp_preenchelacuna . " ORDER BY R.ordem DESC");			
			//Uteis::pr($rs,1);
			$ordem = ($rs ? $rs[0]['ordem'] : "0") + 1;
			$this -> set_ordemResp_preenchelacuna($ordem);
		
			return ($this -> insertResp_preenchelacuna());
		}

	}

	function deletarResp_preenchelacuna($idResp_preenchelacuna) {
		$this -> set_idResp_preenchelacuna($idResp_preenchelacuna);
		return ($this -> deleteResp_preenchelacuna());
	}

}
