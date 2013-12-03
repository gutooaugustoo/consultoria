<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEnderecovirtual = $_REQUEST["idEnderecovirtual"];
?>

<div id="cadastro_enderecovirtual" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_enderecovirtual" divExibir="div_enderecovirtual" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."enderecovirtual/form.php?idEnderecovirtual=".$idEnderecovirtual?>' , '#div_enderecovirtual')" >Endereço Virtual</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_enderecovirtual" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
