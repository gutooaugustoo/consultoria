<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEscrito_pergunta_randomica = $_REQUEST["idEscrito_pergunta_randomica"];
?>

<div id="cadastro_escrito_pergunta_randomica" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_escrito_pergunta_randomica" divExibir="div_escrito_pergunta_randomica" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escrito_pergunta_randomica/form.php?idEscrito_pergunta_randomica=".$idEscrito_pergunta_randomica?>' , '#div_escrito_pergunta_randomica')" >Escrito Pergunta Randomica</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escrito_pergunta_randomica" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
