<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Backgroundidioma = new Backgroundidioma();

$idTabela = "tb_backgroundidioma";
$campos = array("B.id", "B.candidato_id", "B.escola_id", "B.idioma_id", "B.haQuantoTempo", "B.quantoTempo", "B.obs", );

$pessoa_id = $_REQUEST["pessoa_id"];

$url = "?&pessoa_id=".$pessoa_id;
$caminho = CAM_VIEW."backgroundidioma/";
$atualizar = CAM_VIEW."backgroundidioma/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idBackgroundidioma = Uteis::escapeRequest($_REQUEST["idBackgroundidioma"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Backgroundidioma -> tabelaBackgroundidioma_html(" WHERE B.id = $idBackgroundidioma", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE B.excluido = 0 AND B.candidato_id = ".$pessoa_id;

//echo $where;
?>

<fieldset>
  <legend>Background no idioma</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#divLista_res')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Escola", "Idioma", ""));
		echo $Backgroundidioma -> tabelaBackgroundidioma_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
