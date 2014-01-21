<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idTeste = $_REQUEST["idTeste"];
?>

<div id="cadastro_teste" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_teste" divExibir="div_teste" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."teste/form.php?idTeste=".$idTeste?>' , '#div_teste')" >Teste</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_teste" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
