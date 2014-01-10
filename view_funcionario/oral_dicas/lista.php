<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Oral_dicas = new Oral_dicas();

$idTabela = "tb_oral_dicas";

$oral_id = $_REQUEST["oral_id"];
$url = "?oral_id=".$oral_id;

$caminho = CAM_VIEW."oral_dicas/";
$atualizar = CAM_VIEW."oral_dicas/lista.php".$url;
$ondeAtualizar = "#div_oral";	

Html::set_idTabela($idTabela);

//FILTROS
$where = " WHERE O.excluido = 0 AND O.oral_id = ".$oral_id;

//echo $where;
?>

<fieldset>
  <legend>Dicas</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_oral')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Dicas", ""));
		echo $Oral_dicas -> tabelaOral_dicas_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
