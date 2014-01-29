<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idRedacao_temaredacao = $_REQUEST["idRedacao_temaredacao"];

$redacao_id = $_REQUEST["redacao_id"];
$url = "&redacao_id=".$redacao_id;
?>

<div id="cadastro_redacao_temaredacao" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_redacao_temaredacao" divExibir="div_redacao_temaredacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."redacao_temaredacao/form.php?idRedacao_temaredacao=".$idRedacao_temaredacao.$url?>' , '#div_redacao_temaredacao')" >Tema</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_redacao_temaredacao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
