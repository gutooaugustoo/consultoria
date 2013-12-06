<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Descricaotelefone = new Descricaotelefone();

$idTabela = "tb_descricaotelefone";
$campos = array("D.id", "D.nome", );

$url = "?";
$caminho = CAM_VIEW."descricaotelefone/";
$atualizar = CAM_VIEW."descricaotelefone/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idDescricaotelefone = Uteis::escapeRequest($_REQUEST["idDescricaotelefone"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Descricaotelefone -> tabelaDescricaotelefone_html(" WHERE D.id = $idDescricaotelefone", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE D.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Descrição telefone</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", ""));
		echo $Descricaotelefone -> tabelaDescricaotelefone_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
