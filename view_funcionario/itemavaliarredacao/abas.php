<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idItemavaliarredacao = $_REQUEST["idItemavaliarredacao"];
?>

<div id="cadastro_itemavaliarredacao" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_itemavaliarredacao" divExibir="div_itemavaliarredacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."itemavaliarredacao/form.php?idItemavaliarredacao=".$idItemavaliarredacao?>' , '#div_itemavaliarredacao')" >
			Item a avaliar redação
		</div>

	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_itemavaliarredacao" class="div_aba_interna">
			<?php
			include "form.php";
			?>
		</div>
	</div>
</div>
