<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idCandidato_precadastro = $_REQUEST["idCandidato_precadastro"];
?>

<div id="cadastro_candidato_precadastro" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_candidato_precadastro" divExibir="div_candidato_precadastro" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."candidato_precadastro/form.php?idCandidato_precadastro=".$idCandidato_precadastro?>' , '#div_candidato_precadastro')" >Candato Precadastro</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_candidato_precadastro" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
