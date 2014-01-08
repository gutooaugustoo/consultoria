<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idDicasentrevista = $_REQUEST["idDicasentrevista"];
?>

<div id="cadastro_dicasentrevista" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_dicasentrevista" divExibir="div_dicasentrevista" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."dicasentrevista/form.php?idDicasentrevista=".$idDicasentrevista?>' , '#div_dicasentrevista')" >Dicas de entrevista</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_dicasentrevista" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
