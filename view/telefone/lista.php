<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Telefone = new Telefone();

$idTabela = "tb_telefone";
$campos = array("T.id", "T.descricaoTelefone_id", "T.ddd", "T.numero", );

$url = "?&pessoa_id=".$_REQUEST["pessoa_id"];
$caminho = CAM_VIEW."telefone/";
$atualizar = CAM_VIEW."telefone/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idTelefone = Uteis::escapeRequest($_REQUEST["idTelefone"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Telefone -> tabelaTelefone_html(" WHERE T.id = $idTelefone", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
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
  <legend>Telefone</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#divLista_funcionario')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Descricao Telefone", "Ddd", "Numero", ""));
		echo $Telefone -> tabelaTelefone_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
