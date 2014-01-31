<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Escrito_pergunta = new Escrito_pergunta();
$Tipopergunta = new Tipopergunta();

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
  	
  	<?php $rs = $Tipopergunta->selectTipopergunta(" ORDER BY id");
    foreach ($rs as $value) { ?>
      <button class="button gray"
      onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url."&tipoPergunta_id=".$value['id']?>', '<?php echo $atualizar?>', '#div_escrito')" >
        <?php echo $value['descricao'] ?>
      </button>  
    <?php }?>
	
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
