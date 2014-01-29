<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Categoriapergunta = new Categoriapergunta();

$idTabela = "tb_categoriapergunta";
$campos = array("C.id", "C.nome", "C.inativo", );

$url = "?";
$caminho = CAM_VIEW."categoriapergunta/";
$atualizar = CAM_VIEW."categoriapergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idCategoriapergunta = Uteis::escapeRequest($_REQUEST["idCategoriapergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Categoriapergunta -> tabelaCategoriapergunta_html(" WHERE C.id = $idCategoriapergunta", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE C.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Categoria pergunta</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Inativo", ""));
		echo $Categoriapergunta -> tabelaCategoriapergunta_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
