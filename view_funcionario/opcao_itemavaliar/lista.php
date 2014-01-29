<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Opcao_itemavaliar = new Opcao_itemavaliar();

$idTabela = "tb_opcao_itemavaliar";
$campos = array("O.id", "O.itemAvaliarOral_id", "O.opcao", );

$itemAvaliarOral_id = $_REQUEST["itemAvaliarOral_id"];
$url = "?&itemAvaliarOral_id=".$itemAvaliarOral_id;

$caminho = CAM_VIEW."opcao_itemavaliar/";
$atualizar = CAM_VIEW."opcao_itemavaliar/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idOpcao_itemavaliar = Uteis::escapeRequest($_REQUEST["idOpcao_itemavaliar"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Opcao_itemavaliar -> tabelaOpcao_itemavaliar_html(" WHERE O.id = $idOpcao_itemavaliar", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE O.excluido = 0";

$where .= " AND O.itemAvaliarOral_id = ".$itemAvaliarOral_id;

//echo $where;
?>

<fieldset>
  <legend>Opções de resposta</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_itemavaliaroral')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Opção", ""));
		echo $Opcao_itemavaliar -> tabelaOpcao_itemavaliar_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
