<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta = new Escrito_pergunta();

$idTabela = "tb_escrito_pergunta";

$url = "?";
$caminho = CAM_VIEW."escrito_pergunta/";
$atualizar = CAM_VIEW."escrito_pergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEscrito_pergunta = Uteis::escapeRequest($_REQUEST["idEscrito_pergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Escrito_pergunta -> tabelaEscrito_pergunta_html(" WHERE E.id = $idEscrito_pergunta", $caminho, $atualizar, $ondeAtualizar, $ordem);
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
  <legend>Escrito Pergunta</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Escrito", "Pergunta", "Ordem", ""));
		echo $Escrito_pergunta -> tabelaEscrito_pergunta_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
