<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idGestor = $_REQUEST["idGestor"];
$url = "&empresa_id=".$empresa_id;
?>

<div id="cadastro_gestor" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_gestor" divExibir="div_gestor" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."gestor/form.php?idGestor=".$idGestor?>' , '#div_gestor')" >Gestor</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_gestor" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
