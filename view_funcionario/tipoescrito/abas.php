<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idTipoescrito = $_REQUEST["idTipoescrito"];
?>

<div id="cadastro_tipoescrito" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_tipoescrito" divExibir="div_tipoescrito" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."tipoescrito/form.php?idTipoescrito=".$idTipoescrito?>' , '#div_tipoescrito')" >Tipo de teste escrito</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_tipoescrito" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
