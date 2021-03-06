<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Areaatencao = new Areaatencao();

$idTabela = "tb_areaatencao";
$campos = array("A.id", "A.idioma_id", "A.descricao", "A.inativo", );

$url = "?";
$caminho = CAM_VIEW."areaatencao/";
$atualizar = CAM_VIEW."areaatencao/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idAreaatencao = Uteis::escapeRequest($_REQUEST["idAreaatencao"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Areaatencao -> tabelaAreaatencao_html(" WHERE A.id = $idAreaatencao", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE A.excluido = 0";

$idioma_id = implode(",", Uteis::escapeRequest($_POST['idioma_id']));
if( $idioma_id ) $where .= " AND A.idioma_id IN(".$idioma_id.")";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND A.inativo IN(".$status.")";

//echo $where;
?>

<fieldset>
  <legend>Qualidade da comunicação</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_areaatencao')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Idioma", "Descrição", "Status", ""));
		echo $Areaatencao -> tabelaAreaatencao_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
