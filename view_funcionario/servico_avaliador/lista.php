<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico_avaliador = new Servico_avaliador();

$idTabela = "tb_servico_avaliador";

$servico_id = $_REQUEST["servico_id"];
$url = "?servico_id=".$servico_id;

$caminho = CAM_VIEW."servico_avaliador/";
$atualizar = CAM_VIEW."servico_avaliador/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idServico_avaliador = Uteis::escapeRequest($_REQUEST["idServico_avaliador"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Servico_avaliador -> tabelaServico_avaliador_html(" WHERE S.id = $idServico_avaliador", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE S.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Avaliadores vínculados ao serviço</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_servico')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Avaliador", "Valor pago (R$)", ""));
		echo $Servico_avaliador -> tabelaServico_avaliador_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
