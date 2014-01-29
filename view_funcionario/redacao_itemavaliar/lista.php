<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Redacao_itemavaliar = new Redacao_itemavaliar();

$idTabela = "tb_redacao_itemavaliar";

$redacao_id = $_REQUEST["redacao_id"];
$url = "?redacao_id=".$redacao_id;

$caminho = CAM_VIEW."redacao_itemavaliar/";
$atualizar = CAM_VIEW."redacao_itemavaliar/lista.php".$url;
$ondeAtualizar = "#div_redacao";	

Html::set_idTabela($idTabela);

//FILTROS
$where = " WHERE R.excluido = 0 AND R.redacao_id = ".$redacao_id;

//echo $where;
?>

<fieldset>
  <legend>Itens a avaliar</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_redacao')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Item avaliar", ""));
		echo $Redacao_itemavaliar -> tabelaRedacao_itemavaliar_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
