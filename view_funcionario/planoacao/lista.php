<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Planoacao = new Planoacao();

$idTabela = "tb_planoacao";

$url = "?";
$caminho = CAM_VIEW."planoacao/";
$atualizar = CAM_VIEW."planoacao/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idPlanoacao = Uteis::escapeRequest($_REQUEST["idPlanoacao"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Planoacao -> tabelaPlanoacao_html(" WHERE P.id = $idPlanoacao", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE P.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Plano de ação</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_planoacao')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Tipo", "Plano", ""));
		echo $Planoacao -> tabelaPlanoacao_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
