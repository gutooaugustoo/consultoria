<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEscola = $_REQUEST["idEscola"];
?>

<div id="cadastro_escola" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
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
