<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idLocal_oral = $_REQUEST["idLocal_oral"];
?>

<div id="cadastro_local_oral" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_local_oral" divExibir="div_local_oral" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."local_oral/form.php?idLocal_oral=".$idLocal_oral?>' , '#div_local_oral')" >Local onde será realizado</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_local_oral" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
