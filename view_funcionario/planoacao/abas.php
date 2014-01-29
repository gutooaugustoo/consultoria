<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idPlanoacao = $_REQUEST["idPlanoacao"];
?>

<div id="cadastro_planoacao" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_planoacao" divExibir="div_planoacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."planoacao/form.php?idPlanoacao=".$idPlanoacao?>' , '#div_planoacao')" >Plano de ação</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_planoacao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
