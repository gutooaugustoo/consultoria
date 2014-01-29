<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idEscola = $_REQUEST["idEscola"];
?>

<div id="cadastro_escola" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_escola" divExibir="div_escola" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escola/form.php?idEscola=".$idEscola?>' , '#div_escola')" >Escola</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escola" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
