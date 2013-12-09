<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idTemaredacao = $_REQUEST["idTemaredacao"];
?>

<div id="cadastro_temaredacao" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_temaredacao" divExibir="div_temaredacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."temaredacao/form.php?idTemaredacao=".$idTemaredacao?>' , '#div_temaredacao')" >Temaredacao</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_temaredacao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
