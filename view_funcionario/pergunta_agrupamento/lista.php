<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

$pergunta_id = $_REQUEST['pergunta_id'];
$Tipopergunta = new Tipopergunta($tipoPergunta_id);

$idTabela = "tb_perguntaAgrupamento";

$url = "?pergunta_id=" . $pergunta_id;
$caminho = CAM_VIEW . "pergunta/";
$atualizar = CAM_VIEW . "pergunta_agrupamento/lista.php" . $url;
$ondeAtualizar = "#div_pergunta";

Html::set_idTabela($idTabela);

/*if ($_REQUEST["tr"] == "1") {
  //ATUALIZAR APENAS A LINHA
  $idPergunta = Uteis::escapeRequest($_REQUEST["idPergunta"]);
  $ordem = $_REQUEST["ordem"];

  $arrayRetorno["updateTr"] = $Pergunta -> tabelaPergunta_html(" WHERE P.id = $idPergunta", $caminho, $atualizar, $ondeAtualizar, $ordem);
  $arrayRetorno["tabela"] = $idTabela;
  $arrayRetorno["ordem"] = $ordem;

  echo json_encode($arrayRetorno);
  exit ;

}*/

//FILTROS
$where = " WHERE P.excluido = 0 AND P.pergunta_id = " . Uteis::escapeRequest($pergunta_id);

//echo $where;
?>

<fieldset>
	<legend>
		Perguntas dependentes
	</legend>

	<div class="menu_interno">

		<button class="button gray"
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=1"?>', '<?php echo $atualizar?>', '<?php echo $ondeAtualizar?>')" >
			Alternativa Correta
		</button>
		<button class="button gray"
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=2"?>', '<?php echo $atualizar?>', '<?php echo $ondeAtualizar?>')" >
			Verdadeiro ou Falso
		</button>
		<button class="button gray"
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=3"?>', '<?php echo $atualizar?>', '<?php echo $ondeAtualizar?>')" >
			Associe a resposta
		</button>
		<button class="button gray"
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=4"?>', '<?php echo $atualizar?>', '<?php echo $ondeAtualizar?>')" >
			Preencha a lacuna
		</button>
	</div>

	<div class="lista">
		<?php //IMPRIMIR TABELA
    Html::set_colunas(array("Tipo", "Enunciado", "Status", ""));
    echo $Pergunta -> tabelaPerguntaAgrupamento_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>

	<script>
tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>

</fieldset>
