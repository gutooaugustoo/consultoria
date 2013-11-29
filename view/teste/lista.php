<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTeste = $_REQUEST["idTeste"];

$Teste = new Teste();

$idTabela = "tb_teste";
$campos = array("id", "campoString", "campoText", "campoInt", "campoBool", "campoDate", "campoDouble", );

$caminho = CAM_VIEW."teste/";
$atualizar = CAM_VIEW."teste/lista.php";
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Teste->tabelaTeste_html(" WHERE id = $idTeste", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$colunas = array(" Campo String", " Campo Text", " Campo Int", " Campo Bool", " Campo Date", " Campo Double", "");

$where = " WHERE excluido = 0";

Html::set_colunas($colunas);
$corpoTabela = $Teste->tabelaTeste_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
?>

<fieldset>
  <legend> Teste</legend>
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
