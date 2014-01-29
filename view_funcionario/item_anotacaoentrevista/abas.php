<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idItem_anotacaoentrevista = $_REQUEST["idItem_anotacaoentrevista"];
?>

<div id="cadastro_item_anotacaoentrevista" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_item_anotacaoentrevista" divExibir="div_item_anotacaoentrevista" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."item_anotacaoentrevista/form.php?idItem_anotacaoentrevista=".$idItem_anotacaoentrevista?>' , '#div_item_anotacaoentrevista')" >Item para anotar na entrevista</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_item_anotacaoentrevista" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
