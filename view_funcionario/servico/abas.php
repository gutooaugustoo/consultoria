<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico = $_REQUEST["idServico"];
?>

<div id="cadastro_servico" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico" divExibir="div_servico" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico/form.php?idServico=".$idServico?>' , '#div_servico')" >Servico</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
