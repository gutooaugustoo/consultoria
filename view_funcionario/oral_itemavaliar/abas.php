<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idOral_itemavaliar = $_REQUEST["idOral_itemavaliar"];

$oral_id = $_REQUEST["oral_id"];
$url = "&oral_id=".$oral_id;
?>

<div id="cadastro_oral_itemavaliar" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_oral_itemavaliar" divExibir="div_oral_itemavaliar" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."oral_itemavaliar/form.php?idOral_itemavaliar=".$idOral_itemavaliar.$url?>' , '#div_oral_itemavaliar')" >Item avaliar</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_oral_itemavaliar" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
