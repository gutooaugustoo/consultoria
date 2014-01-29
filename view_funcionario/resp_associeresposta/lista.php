<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Resp_associeresposta = new Resp_associeresposta();

$idTabela = "tb_resp_associeresposta";

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "?pergunta_id=".$pergunta_id;

$caminho = CAM_VIEW."resp_associeresposta/";
$atualizar = CAM_VIEW."resp_associeresposta/lista.php".$url;
$ondeAtualizar = "#div_pergunta";	

Html::set_idTabela($idTabela);

/*if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idResp_associeresposta = Uteis::escapeRequest($_REQUEST["idResp_associeresposta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Resp_associeresposta -> tabelaResp_associeresposta_html(" WHERE R.id = $idResp_associeresposta", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}*/

//FILTROS
$where = " WHERE R.excluido = 0 AND R.pergunta_id = ".Uteis::escapeRequest($pergunta_id);

//echo $where;
?>

<fieldset>
  <legend>Respostas</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '<?php echo $ondeAtualizar?>')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Opção original", "Opção associada", ""));
		echo $Resp_associeresposta -> tabelaResp_associeresposta_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
