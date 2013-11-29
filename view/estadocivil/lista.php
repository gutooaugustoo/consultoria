<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEstadocivil = $_REQUEST["idEstadocivil"];

$Estadocivil = new Estadocivil();

$idTabela = "tb_estadocivil";
$campos = array("id", "nome", );

$caminho = CAM_VIEW."estadocivil/";
$atualizar = CAM_VIEW."estadocivil/lista.php";
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Estadocivil -> tabelaEstadocivil_html(" WHERE id = $idEstadocivil", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$colunas = array("Nome", "");

$where .= "";

Html::set_colunas($colunas);
$corpoTabela = $Estadocivil -> tabelaEstadocivil_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
?>

<fieldset>
  <legend>Estadocivil</legend>
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
