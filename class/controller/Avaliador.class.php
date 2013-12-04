<?php
class Avaliador extends Avaliador_m {

	//CONSTRUTOR
	function __construct($idAvaliador = "") {
		parent::__construct($idAvaliador);
	}

	function __destruct() {
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectAvaliador_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array(
			"id",
			" AS legenda"
		);
		$array = $this -> selectAvaliador($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}

	function selectMultipleAvaliador_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array(
			"id",
			" AS legenda"
		);
		$array = $this -> selectAvaliador($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}

	/*function checkBoxAvaliador_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
	 $where .= "";
	 $campos = array("id", " AS legenda");
	 $array = $this -> selectAvaliador($where, $campos);
	 return Html::selectMultiple($nomeId, $idAtual, $array);
	 }*/

	function tabelaAvaliador_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false) {

		$array = $this -> selectAvaliador($where, $campos);

		if ($array) {

			$cont = 0;
			$linha = array();

			foreach ($array as $iten) {

				$colunas = array();

				//CARREGAR VALORES
				$this -> __construct($iten['id']);

				$colunas[] = $this -> get_nomePessoa();
				$Tipodocumentounico = new Tipodocumentounico($this -> get_tipoDocumentoUnico_idPessoa());
				$colunas[] = $this -> get_documentoPessoa() . " (" . $Tipodocumentounico -> get_nomeTipodocumentounico() . ")";
				$colunas[] = $this -> get_inativoPessoa(true);

				$ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
				$urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
				$atualizarFinal = $atualizar . $urlAux . "&tr=1&idAvaliador=" . $this -> get_idAvaliador();

				$editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idAvaliador=" . $this -> get_idAvaliador() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

				$deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idAvaliador() . "', '$atualizarFinal', '$ondeAtualizar')\">";

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
	function cadastrarAvaliador($idAvaliador, $post = array()) {

		$rs = $this -> cadastrarPessoa($idAvaliador, $post);
		
		if ($rs[0] != false) {

			if ($idAvaliador) {
				$this -> set_idAvaliador($idAvaliador);
				return ($this -> updateAvaliador());
			} else {
				$this -> set_idAvaliador($rs[0]);
				return ($this -> insertAvaliador());
			}
			
		} else {
			return $rs;
		}

	}

	function deletarAvaliador($idAvaliador) {
		$this -> set_idAvaliador($idAvaliador);
		return ($this -> deleteAvaliador());
	}

}
