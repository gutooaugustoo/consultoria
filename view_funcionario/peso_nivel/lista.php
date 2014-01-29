<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Peso_nivel = new Peso_nivel();

$idTabela = "tb_peso_nivel";

$escrito_id = $_REQUEST["escrito_id"];
$url = "?escrito_id=".$escrito_id;

$caminho = CAM_VIEW."peso_nivel/";
$atualizar = CAM_VIEW."peso_nivel/lista.php".$url;
$ondeAtualizar = "#div_escrito";	

Html::set_idTabela($idTabela);

//FILTROS
$where = " WHERE P.excluido = 0 AND P.escrito_id = ".$escrito_id;

//echo $where;
?>

<fieldset>
  <legend>Peso do teste</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_escrito')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nivel da pergunta", "Peso", ""));
		echo $Peso_nivel -> tabelaPeso_nivel_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
