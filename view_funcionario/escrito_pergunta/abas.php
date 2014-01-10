<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEscrito_pergunta = $_REQUEST["idEscrito_pergunta"];
?>

<div id="cadastro_escrito_pergunta" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_escrito_pergunta" divExibir="div_escrito_pergunta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escrito_pergunta/form.php?idEscrito_pergunta=".$idEscrito_pergunta?>' , '#div_escrito_pergunta')" >Escrito Pergunta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escrito_pergunta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
