<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPais = $_REQUEST["idPais"];

$Pais = new Pais();

$idTabela = "tb_pais";
$campos = array("id", "nacionalidade", "pais", );

$caminho = CAM_VIEW."pais/";
$atualizar = CAM_VIEW."pais/lista.php";
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Pais -> tabelaPais_html(" WHERE id = $idPais", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$colunas = array("Nacionalade", "Pais", "");

$where .= "";

Html::set_colunas($colunas);
$corpoTabela = $Pais -> tabelaPais_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
?>

<fieldset>
  <legend>Pais</legend>
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
