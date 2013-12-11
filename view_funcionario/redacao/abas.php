<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idRedacao = $_REQUEST["idRedacao"];

$servico_id = $_REQUEST["servico_id"];
$url = "&servico_id=".$servico_id;
?>

<div id="cadastro_redacao" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_redacao" divExibir="div_redacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."redacao/form.php?idRedacao=".$idRedacao.$url?>' , '#div_redacao')" >Redacao</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_redacao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
