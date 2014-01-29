<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Idioma = new Idioma();

$idTabela = "tb_idioma";
$campos = array("I.id", "I.nome", );

$url = "?";
$caminho = CAM_VIEW."idioma/";
$atualizar = CAM_VIEW."idioma/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idIdioma = Uteis::escapeRequest($_REQUEST["idIdioma"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Idioma -> tabelaIdioma_html(" WHERE I.id = $idIdioma", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE I.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Idioma</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", ""));
		echo $Idioma -> tabelaIdioma_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
