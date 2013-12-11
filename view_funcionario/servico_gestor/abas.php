<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico_gestor = $_REQUEST["idServico_gestor"];
?>

<div id="cadastro_servico_gestor" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico_gestor" divExibir="div_servico_gestor" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_gestor/form.php?idServico_gestor=".$idServico_gestor?>' , '#div_servico_gestor')" >Servico Gestor</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico_gestor" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
