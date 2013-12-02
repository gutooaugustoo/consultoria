<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPais = $_REQUEST["idPais"];

$Pais = new Pais();

$caminho = CAM_VIEW."pais/";
$atualizar = CAM_VIEW."pais/lista.php";
$ondeAtualizar = "tr";	

$idTabela = "tb_pais";
$campos = array("P.id", "P.nacionalidade", "P.pais", );

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

$where .= " WHERE 1 ";

$colunas = array("Nacionalade", "Pais", "");

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
		<?php echo $corpoTabela;?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
