<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Endereco = new Endereco();

$idTabela = "tb_endereco";
$campos = array("E.id", "E.pessoa_id", "E.empresa_id", "E.pais_id", "E.cidade_id", "E.bairro", "E.numero", "E.cep", "E.complemento", "E.cidadeEstrangeira", );

$url = "?";
$caminho = CAM_VIEW."endereco/";
$atualizar = CAM_VIEW."endereco/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEndereco = Uteis::escapeRequest($_REQUEST["idEndereco"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Endereco -> tabelaEndereco_html(" WHERE E.id = $idEndereco", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE E.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Endereço</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#divLista_funcionario')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Endereço completo", ""));
		echo $Endereco -> tabelaEndereco_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
