<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idOral_dicas = $_REQUEST["idOral_dicas"];

$oral_id = $_REQUEST["oral_id"];
$url = "&oral_id=".$oral_id;
?>

<div id="cadastro_oral_dicas" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_oral_dicas" divExibir="div_oral_dicas" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."oral_dicas/form.php?idOral_dicas=".$idOral_dicas.$url?>' , '#div_oral_dicas')" >Dicas</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_oral_dicas" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
