<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Itemavaliaroral = new Itemavaliaroral();

$idTabela = "tb_itemavaliaroral";
$campos = array("I.id", "I.enunciado", "I.dicaComoResponder", "I.padrao", "I.inativo", );

$url = "?";
$caminho = CAM_VIEW."itemavaliaroral/";
$atualizar = CAM_VIEW."itemavaliaroral/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idItemavaliaroral = Uteis::escapeRequest($_REQUEST["idItemavaliaroral"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Itemavaliaroral -> tabelaItemavaliaroral_html(" WHERE I.id = $idItemavaliaroral", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
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
  <legend>Item a avaliar teste oral</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_itemavaliaroral')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Item", "Padrao", "Status", ""));
		echo $Itemavaliaroral -> tabelaItemavaliaroral_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
