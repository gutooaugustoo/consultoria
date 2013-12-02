<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idFuncionario = $_REQUEST["idFuncionario"];

$Funcionario = new Funcionario();

$caminho = CAM_VIEW."funcionario/";
$atualizar = CAM_VIEW."funcionario/lista.php";
$ondeAtualizar = "tr";	

$idTabela = "tb_funcionario";
$campos = array("F.id", );

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Funcionario -> tabelaFuncionario_html(" WHERE id = $idFuncionario", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$where .= " WHERE 1 ";

$colunas = array("");

Html::set_colunas($colunas);
$corpoTabela = $Funcionario -> tabelaFuncionario_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);

?>

<fieldset>
  <legend>Funcionario</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."form.php"?>', 'click', '#btFiltro_funcionario')" /> 
  </div>
  
  <div class="lista">
		<?php echo $corpoTabela;?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
