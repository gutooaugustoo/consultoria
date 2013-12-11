<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEscrito = $_REQUEST["idEscrito"];

$servico_id = $_REQUEST["servico_id"];
$url = "&servico_id=".$servico_id;
?>

<div id="cadastro_escrito" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_escrito" divExibir="div_escrito" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escrito/form.php?idEscrito=".$idEscrito.$url?>' , '#div_escrito')" >Escrito</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escrito" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
