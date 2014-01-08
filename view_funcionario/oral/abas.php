<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idOral = $_REQUEST["idOral"];

$servico_id = $_REQUEST["servico_id"];
$etapa_id = $_REQUEST["etapa_id"];

$url = "&servico_id=".$servico_id."&etapa_id=".$etapa_id;
?>

<div id="cadastro_oral" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_oral" divExibir="div_oral" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."oral/form.php?idOral=".$idOral.$url?>' , '#div_oral')" >Oral</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_oral" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
