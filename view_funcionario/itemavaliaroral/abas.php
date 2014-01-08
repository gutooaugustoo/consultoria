<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idItemavaliaroral = $_REQUEST["idItemavaliaroral"];
$url = "&itemAvaliarOral_id=".$idItemavaliaroral;
?>

<div id="cadastro_itemavaliaroral" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_itemavaliaroral" divExibir="div_itemavaliaroral" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."itemavaliaroral/form.php?idItemavaliaroral=".$idItemavaliaroral?>' , '#div_itemavaliaroral')" >
			Item a avaliar teste oral
		</div>
		<?php if( $idItemavaliaroral ) {
		?>
		<div id="aba_opcao_itemavaliar" divExibir="div_itemavaliaroral" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."opcao_itemavaliar/lista.php?idOpcao_itemavaliar=".$idOpcao_itemavaliar.$url?>' , '#div_itemavaliaroral')" >
			Opções de resposta
		</div>
		<?php } ?>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_itemavaliaroral" class="div_aba_interna">
			<?php
			include "form.php";
			?>
		</div>
	</div>
</div>
