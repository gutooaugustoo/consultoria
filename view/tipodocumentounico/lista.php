<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTipodocumentounico = $_REQUEST["idTipodocumentounico"];

$Tipodocumentounico = new Tipodocumentounico();

$idTabela = "tb_tipodocumentounico";
$campos = array("id", "nome", "class", );

$caminho = CAM_VIEW."tipodocumentounico/";
$atualizar = CAM_VIEW."tipodocumentounico/lista.php";
$ondeAtualizar = "tr";	

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

$colunas = array("Nome", "Class", "");

$where .= "";

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
  	<?php echo $corpoTabela?>      
  </div>
</fieldset>
<script>
tabelaDataTable('<?php echo $idTabela?>', '');
</script> 
