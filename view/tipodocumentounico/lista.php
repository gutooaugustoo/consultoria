<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTipodocumentounico = $_REQUEST["idTipodocumentounico"];

$Tipodocumentounico = new Tipodocumentounico();

$caminho = CAM_VIEW."tipodocumentounico/";
$atualizar = CAM_VIEW."tipodocumentounico/lista.php";
$ondeAtualizar = "tr";	

$idTabela = "tb_tipodocumentounico";
$campos = array("T.id", "T.nome", "T.class", );

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Tipodocumentounico -> tabelaTipodocumentounico_html(" WHERE id = $idTipodocumentounico", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$where .= " WHERE 1 ";

$colunas = array("Nome", "Class", "");

Html::set_colunas($colunas);
$corpoTabela = $Tipodocumentounico -> tabelaTipodocumentounico_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);

?>

<fieldset>
  <legend>Tipodocumentounico</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."form.php"?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php echo $corpoTabela;?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
