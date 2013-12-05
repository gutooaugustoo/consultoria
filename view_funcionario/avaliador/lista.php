<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Avaliador = new Avaliador();

$idTabela = "tb_avaliador";
$campos = array("A.id", );

$url = "?";
$caminho = CAM_VIEW."avaliador/";
$atualizar = CAM_VIEW."avaliador/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idAvaliador = Uteis::escapeRequest($_REQUEST["idAvaliador"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Avaliador -> tabelaAvaliador_html(" WHERE A.id = $idAvaliador", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where .= " WHERE 1 ";

$status = implode(",", $_POST['status']);
if( $status != "" ) $where .= " AND P.inativo IN(".Uteis::escapeRequest($status).")";
//echo $where;
?>

<fieldset>
  <legend>Avaliador</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_avaliador')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Documento", "Status", ""));
		echo $Avaliador -> tabelaAvaliador_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
