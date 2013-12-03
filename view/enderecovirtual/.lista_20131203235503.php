<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$Enderecovirtual = new Enderecovirtual();

$idTabela = "tb_enderecovirtual";
$campos = array("E.id", "E.empresa_id", "E.pessoa_id", "E.tipoEnderecoVirtual_id", "E.nome", );
$caminho = CAM_VIEW."enderecovirtual/";
$atualizar = CAM_VIEW."enderecovirtual/lista.php";
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEnderecovirtual = Uteis::escapeRequest($_REQUEST["idEnderecovirtual"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Enderecovirtual -> tabelaEnderecovirtual_html(" WHERE E.id = $idEnderecovirtual", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
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
  <legend>Endereço Virtual</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php"?>', '<?php echo $atualizar?>', '#divLista_funcionario')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Tipo Endereco Virtual", "Nome", ""));
		echo $Enderecovirtual -> tabelaEnderecovirtual_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
