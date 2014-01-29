<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Escrito_pergunta = new Escrito_pergunta();

$idTabela = "tb_escrito_pergunta";

$escrito_id = $_REQUEST["escrito_id"];
$url = "?escrito_id=".$escrito_id;

$caminho = CAM_VIEW."escrito_pergunta/";
$atualizar = CAM_VIEW."escrito_pergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEscrito_pergunta = Uteis::escapeRequest($_REQUEST["idEscrito_pergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Escrito_pergunta -> tabelaEscrito_pergunta_html(" WHERE E.id = $idEscrito_pergunta", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE E.excluido = 0 AND E.escrito_id = ".$escrito_id;

//echo $where;
?>

<fieldset>
  <legend>Perguntas</legend>
  
  <div class="menu_interno"> 
  	<!--<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_escrito')" />-->
		
		<button class="button gray"
    onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=1"?>', '<?php echo $atualizar?>', '#div_escrito')" >
      Alternativa Correta
    </button>
    <button class="button gray"
    onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=2"?>', '<?php echo $atualizar?>', '#div_escrito')" >
      Verdadeiro ou Falso
    </button>
    <button class="button gray"
    onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=3"?>', '<?php echo $atualizar?>', '#div_escrito')" >
      Associe a resposta
    </button>
    <button class="button gray"
    onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=4"?>', '<?php echo $atualizar?>', '#div_escrito')" >
      Preencha a lacuna
    </button>
    <button class="button gray"
    onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=5"?>', '<?php echo $atualizar?>', '#div_escrito')" >
      Agrupamento
    </button>
     
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Ordem", "Tipo", "Pergunta", ""));
		echo $Escrito_pergunta -> tabelaEscrito_pergunta_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
