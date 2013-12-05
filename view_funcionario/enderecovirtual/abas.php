<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEnderecovirtual = $_REQUEST["idEnderecovirtual"];

$pessoa_id = $_REQUEST["pessoa_id"];
$empresa_id = $_REQUEST["empresa_id"];
$url = "&pessoa_id=".$pessoa_id."&empresa_id=".$empresa_id;
?>

<div id="cadastro_enderecovirtual" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_enderecovirtual" divExibir="div_enderecovirtual" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."enderecovirtual/form.php?idEnderecovirtual=".$idEnderecovirtual.$url?>' , '#div_enderecovirtual')" >Endereço Virtual</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_enderecovirtual" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
