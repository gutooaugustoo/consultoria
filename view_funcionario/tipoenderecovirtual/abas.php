<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idTipoenderecovirtual = $_REQUEST["idTipoenderecovirtual"];
?>

<div id="cadastro_tipoenderecovirtual" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_tipoenderecovirtual" divExibir="div_tipoenderecovirtual" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."tipoenderecovirtual/form.php?idTipoenderecovirtual=".$idTipoenderecovirtual?>' , '#div_tipoenderecovirtual')" >Tipo de endereço virtual</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_tipoenderecovirtual" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
