<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Enderecovirtual = new Enderecovirtual();

$idTabela = "tb_enderecovirtual";
$campos = array("E.id", "E.empresa_id", "E.pessoa_id", "E.tipoEnderecoVirtual_id", "E.nome", );

$pessoa_id = $_REQUEST["pessoa_id"];
$empresa_id = $_REQUEST["empresa_id"];

$url = "?&pessoa_id=".$pessoa_id."&empresa_id=".$empresa_id;
$caminho = CAM_VIEW."enderecovirtual/";
$atualizar = CAM_VIEW."enderecovirtual/lista.php".$url;
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

if( $pessoa_id ) $where .= " AND E.pessoa_id = ".$pessoa_id;
if( $empresa_id ) $where .= " AND E.empresa_id = ".$empresa_id; 
//echo $where;
?>

<fieldset>
  <legend>Enderecovirtual</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#divLista_res')" /> 
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
