<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Resp_preenchelacuna = new Resp_preenchelacuna();

$idTabela = "tb_resp_preenchelacuna";

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "?pergunta_id=".$pergunta_id;

$caminho = CAM_VIEW."resp_preenchelacuna/";
$atualizar = CAM_VIEW."resp_preenchelacuna/lista.php".$url;
$ondeAtualizar = "#div_pergunta";	

Html::set_idTabela($idTabela);

/*if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idResp_preenchelacuna = Uteis::escapeRequest($_REQUEST["idResp_preenchelacuna"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Resp_preenchelacuna -> tabelaResp_preenchelacuna_html(" WHERE R.id = $idResp_preenchelacuna", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}*/

//FILTROS
$where = " WHERE R.excluido = 0 AND R.pergunta_id = ".$pergunta_id;

//echo $where;
?>

<fieldset>
  <legend>Respostas</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_pergunta')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Ordem", "Lacuna", ""));
		echo $Resp_preenchelacuna -> tabelaResp_preenchelacuna_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>