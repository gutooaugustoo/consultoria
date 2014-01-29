<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Temaredacao = new Temaredacao();

$idTabela = "tb_temaredacao";
$campos = array("T.id", "T.titulo", "T.tema", "T.inativo", );

$url = "?";
$caminho = CAM_VIEW."temaredacao/";
$atualizar = CAM_VIEW."temaredacao/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idTemaredacao = Uteis::escapeRequest($_REQUEST["idTemaredacao"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Temaredacao -> tabelaTemaredacao_html(" WHERE T.id = $idTemaredacao", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE T.excluido = 0";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND T.inativo IN(".($status).")";
//echo $where;
?>

<fieldset>
  <legend>Tema Redação</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_temaredacao')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Titulo", "Status", ""));
		echo $Temaredacao -> tabelaTemaredacao_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
