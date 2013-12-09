<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idPergunta = $_REQUEST["idPergunta"];
?>

<div id="cadastro_pergunta" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_pergunta" divExibir="div_pergunta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."pergunta/form.php?idPergunta=".$idPergunta?>' , '#div_pergunta')" >Pergunta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_pergunta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
