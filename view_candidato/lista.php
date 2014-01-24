<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico_candidato = new Servico_candidato();

$idTabela = "tb_servico";

$url = "?";
$caminho = CAM_VIEW."servico/";
$atualizar = CAM_VIEW."servico/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

//echo $where;
?>

<fieldset>
  <legend>Serviços</legend>
  
  <div class="menu_interno"> 
 <!-- 	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_servico')" /> --> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Etapa", "Teste", "Status", ""));
		echo $Servico_candidato -> tabela_areaCandidato_html($_SESSION['servico_candidato_id'], $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
