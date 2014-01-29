<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico_candidato = new Servico_candidato();

$idTabela = "tb_servico_candidato";

$servico_id = $_REQUEST["servico_id"];
$url = "?servico_id=".$servico_id;

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
$where = " WHERE S.excluido = 0 AND S.servico_id = ".Uteis::escapeRequest($servico_id);

//echo $where;
?>

<fieldset>
  <legend>Candidatos vínculados ao serviço</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_servico')" />
				
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Candidato", "Data Validade", ""));
		echo $Servico_candidato -> tabelaServico_candidato_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
