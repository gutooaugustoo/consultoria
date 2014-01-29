<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idServico_gestor = $_REQUEST["idServico_gestor"];

$servico_id = $_REQUEST["servico_id"];
$url = "&servico_id=".$servico_id;
?>

<div id="cadastro_servico_gestor" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico_gestor" divExibir="div_servico_gestor" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_gestor/form.php?idServico_gestor=".$idServico_gestor.$url?>' , '#div_servico_gestor')" >Gestor vínculado ao serviço</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico_gestor" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
