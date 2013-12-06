<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idNivelcandidato = $_REQUEST["idNivelcandidato"];
?>

<div id="cadastro_nivelcandidato" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_nivelcandidato" divExibir="div_nivelcandidato" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."nivelcandidato/form.php?idNivelcandidato=".$idNivelcandidato?>' , '#div_nivelcandidato')" >Nível candiaato</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_nivelcandidato" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
