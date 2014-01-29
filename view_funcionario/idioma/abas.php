<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idIdioma = $_REQUEST["idIdioma"];
?>

<div id="cadastro_idioma" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_idioma" divExibir="div_idioma" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."idioma/form.php?idIdioma=".$idIdioma?>' , '#div_idioma')" >Idioma</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_idioma" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
