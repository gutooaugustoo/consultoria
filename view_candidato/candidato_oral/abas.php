<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idCandidato_oral = $_REQUEST["idCandidato_oral"];
?>

<div id="cadastro_candidato_oral" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_candidato_oral" divExibir="div_candidato_oral" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."candidato_oral/form.php?idCandidato_oral=".$idCandidato_oral?>' , '#div_candidato_oral')" >Candato Oral</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_candidato_oral" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>