<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Nivelpergunta = new Nivelpergunta();

$idTabela = "tb_nivelpergunta";
$campos = array("N.id", "N.nome", "N.inativo", );

$url = "?";
$caminho = CAM_VIEW."nivelpergunta/";
$atualizar = CAM_VIEW."nivelpergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idNivelpergunta = Uteis::escapeRequest($_REQUEST["idNivelpergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Nivelpergunta -> tabelaNivelpergunta_html(" WHERE N.id = $idNivelpergunta", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE N.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Nível pergunta</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nível", "Inativo", ""));
		echo $Nivelpergunta -> tabelaNivelpergunta_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
