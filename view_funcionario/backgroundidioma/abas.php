<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idBackgroundidioma = $_REQUEST["idBackgroundidioma"];
?>

<div id="cadastro_backgroundidioma" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_backgroundidioma" divExibir="div_backgroundidioma" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."backgroundidioma/form.php?idBackgroundidioma=".$idBackgroundidioma?>' , '#div_backgroundidioma')" >Background no idioma</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_backgroundidioma" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
