<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Oral_itemavaliar = new Oral_itemavaliar();

$idTabela = "tb_oral_itemavaliar";

$oral_id = $_REQUEST["oral_id"];
$url = "?oral_id=".$oral_id;

$caminho = CAM_VIEW."oral_itemavaliar/";
$atualizar = CAM_VIEW."oral_itemavaliar/lista.php".$url;
$ondeAtualizar = "#div_oral";	

Html::set_idTabela($idTabela);

//FILTROS
$where = " WHERE O.excluido = 0 AND O.oral_id = ".$oral_id;

//echo $where;
?>

<fieldset>
  <legend>Itens a avaliar</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_oral')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Itens a avaliar", ""));
		echo $Oral_itemavaliar -> tabelaOral_itemavaliar_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
