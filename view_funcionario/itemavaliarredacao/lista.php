<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Itemavaliarredacao = new Itemavaliarredacao();

$idTabela = "tb_itemavaliarredacao";
$campos = array("I.id", "I.enunciado", "I.dicaComoResponder", "I.inativo", "I.padrao", );

$url = "?";
$caminho = CAM_VIEW."itemavaliarredacao/";
$atualizar = CAM_VIEW."itemavaliarredacao/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idItemavaliarredacao = Uteis::escapeRequest($_REQUEST["idItemavaliarredacao"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Itemavaliarredacao -> tabelaItemavaliarredacao_html(" WHERE I.id = $idItemavaliarredacao", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE I.excluido = 0";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND I.inativo IN(".$status.")";
//echo $where;
?>

<fieldset>
  <legend>Item à avaliar redação</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_itemavaliarredacao')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Item", "Padrão", "Status", ""));
		echo $Itemavaliarredacao -> tabelaItemavaliarredacao_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
