<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico_candidato = new Servico_candidato();

$idTabela = "tb_servico_candidato";
//$campos = array("S.id", "S.servico_id", "S.candidato_id", "S.dataValidade", );

$url = "?";
$caminho = CAM_VIEW."servico_candidato/";
$atualizar = CAM_VIEW."servico_candidato/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idServico_candidato = Uteis::escapeRequest($_REQUEST["idServico_candidato"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Servico_candidato -> tabelaServico_candidato_html(" WHERE S.id = $idServico_candidato", $caminho, $atualizar, $ondeAtualizar, $ordem);
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
  <legend>Servico Candato</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Servico", "Candato", "Data Valade", ""));
		echo $Servico_candidato -> tabelaServico_candidato_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
