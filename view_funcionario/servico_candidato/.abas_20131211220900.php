<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico_candidato = $_REQUEST["idServico_candidato"];
?>

<div id="cadastro_servico_candidato" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico_candidato" divExibir="div_servico_candidato" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_candidato/form.php?idServico_candidato=".$idServico_candidato?>' , '#div_servico_candidato')" >Servico Candato</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico_candidato" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
