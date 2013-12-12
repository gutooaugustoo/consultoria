<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico = new Servico();

$idTabela = "tb_servico";

$url = "?";
$caminho = CAM_VIEW."servico/";
$atualizar = CAM_VIEW."servico/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idServico = Uteis::escapeRequest($_REQUEST["idServico"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Servico -> tabelaServico_html(" WHERE S.id = $idServico", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE S.excluido = 0";

$empresa_id = implode(",", Uteis::escapeRequest($_POST['empresa_id']));
if( $empresa_id ) $where .= " AND S.empresa_id IN(".($empresa_id).")";

$idioma_id = implode(",", Uteis::escapeRequest($_POST['idioma_id']));
if( $idioma_id ) $where .= " AND S.idioma_id IN(".($idioma_id).")";

/*$servico_id = implode(",", Uteis::escapeRequest($_POST['servico_id']));
if( $servico_id ) $where .= " AND S.servico_id IN(".($servico_id).")";*/

//echo $where;
?>

<fieldset>
  <legend>Serviços</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_servico')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Descrição", "Empresa", "Idioma", "Período", "Oral", "Escrito", "Redação", "Resultado Final", ""));
		echo $Servico -> tabelaServico_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
