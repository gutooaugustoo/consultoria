<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$escrito_id = $_REQUEST["escrito_id"];

$url = "&escrito_id=".$escrito_id;

?>

<div id="cadastro_escrito_pergunta_randomica" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_escrito_pergunta_randomica" divExibir="div_escrito_pergunta_randomica" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escrito_pergunta_randomica/form.php?idEscrito_pergunta_randomica=".$idEscrito_pergunta_randomica.$url?>' , '#div_escrito_pergunta_randomica')" >
		Pergunta randomica</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escrito_pergunta_randomica" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
