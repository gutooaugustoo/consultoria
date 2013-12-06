<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Tipoenderecovirtual = new Tipoenderecovirtual();

$idTabela = "tb_tipoenderecovirtual";
$campos = array("T.id", "T.nome", );

$url = "?";
$caminho = CAM_VIEW."tipoenderecovirtual/";
$atualizar = CAM_VIEW."tipoenderecovirtual/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idTipoenderecovirtual = Uteis::escapeRequest($_REQUEST["idTipoenderecovirtual"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Tipoenderecovirtual -> tabelaTipoenderecovirtual_html(" WHERE T.id = $idTipoenderecovirtual", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE T.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Tipo de endereço virtual</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", ""));
		echo $Tipoenderecovirtual -> tabelaTipoenderecovirtual_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
