<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta_randomica = new Escrito_pergunta_randomica();

$idTabela = "tb_escrito_pergunta_randomica";

$escrito_id = $_REQUEST["escrito_id"];
$url = "?escrito_id=".$escrito_id;

$caminho = CAM_VIEW."escrito_pergunta_randomica/";
$atualizar = CAM_VIEW."escrito_pergunta_randomica/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

//FILTROS
$where = " WHERE E.excluido = 0 AND E.escrito_id = ".$escrito_id;

//echo $where;
?>

<fieldset>
  <legend>Perguntas randomicas</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#div_escrito')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Idiioma", "Nivel", "Categoria", "Quantidade de questões", ""));
		echo $Escrito_pergunta_randomica -> tabelaEscrito_pergunta_randomica_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
