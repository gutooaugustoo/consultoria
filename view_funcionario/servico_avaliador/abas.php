<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idServico_avaliador = $_REQUEST["idServico_avaliador"];

$servico_id = $_REQUEST["servico_id"];
$url = "&servico_id=".$servico_id;
?>

<div id="cadastro_servico_avaliador" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico_avaliador" divExibir="div_servico_avaliador" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_avaliador/form.php?idServico_avaliador=".$idServico_avaliador.$url?>' , '#div_servico_avaliador')" >Avaliador vínculado ao serviço</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico_avaliador" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
