<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Item_anotacaoentrevista = new Item_anotacaoentrevista();

$idTabela = "tb_item_anotacaoentrevista";
$campos = array("I.id", "I.item", );

$url = "?";
$caminho = CAM_VIEW."item_anotacaoentrevista/";
$atualizar = CAM_VIEW."item_anotacaoentrevista/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idItem_anotacaoentrevista = Uteis::escapeRequest($_REQUEST["idItem_anotacaoentrevista"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Item_anotacaoentrevista -> tabelaItem_anotacaoentrevista_html(" WHERE I.id = $idItem_anotacaoentrevista", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where .= " WHERE 1 ";

//echo $where;
?>

<fieldset>
  <legend>Item para anotar na entrevista</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Item", ""));
		echo $Item_anotacaoentrevista -> tabelaItem_anotacaoentrevista_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
