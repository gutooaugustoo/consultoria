<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta_randomica = new Escrito_pergunta_randomica();

$idTabela = "tb_escrito_pergunta_randomica";

$url = "?";
$caminho = CAM_VIEW."escrito_pergunta_randomica/";
$atualizar = CAM_VIEW."escrito_pergunta_randomica/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEscrito_pergunta_randomica = Uteis::escapeRequest($_REQUEST["idEscrito_pergunta_randomica"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Escrito_pergunta_randomica -> tabelaEscrito_pergunta_randomica_html(" WHERE E.id = $idEscrito_pergunta_randomica", $caminho, $atualizar, $ondeAtualizar, $ordem);
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
  <legend>Escrito Pergunta Randomica</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Escrito", "Nivel Pergunta", "Categoria Pergunta", "ioma", "Quantade", ""));
		echo $Escrito_pergunta_randomica -> tabelaEscrito_pergunta_randomica_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
