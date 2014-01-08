<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idNivelpergunta = $_REQUEST["idNivelpergunta"];
?>

<div id="cadastro_nivelpergunta" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_nivelpergunta" divExibir="div_nivelpergunta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."nivelpergunta/form.php?idNivelpergunta=".$idNivelpergunta?>' , '#div_nivelpergunta')" >Nível pergunta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_nivelpergunta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
