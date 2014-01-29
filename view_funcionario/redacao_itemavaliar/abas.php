<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idRedacao_itemavaliar = $_REQUEST["idRedacao_itemavaliar"];

$redacao_id = $_REQUEST["redacao_id"];
$url = "&redacao_id=".$redacao_id;
?>

<div id="cadastro_redacao_itemavaliar" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_redacao_itemavaliar" divExibir="div_redacao_itemavaliar" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."redacao_itemavaliar/form.php?idRedacao_itemavaliar=".$idRedacao_itemavaliar.$url?>' , '#div_redacao_itemavaliar')" >Item avaliar</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_redacao_itemavaliar" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
