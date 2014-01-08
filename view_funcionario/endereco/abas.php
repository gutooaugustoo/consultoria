<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEndereco = $_REQUEST["idEndereco"];

$pessoa_id = $_REQUEST["pessoa_id"];
$empresa_id = $_REQUEST["empresa_id"];
$url = "&pessoa_id=".$pessoa_id."&empresa_id=".$empresa_id;
?>

<div id="cadastro_endereco" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_endereco" divExibir="div_endereco" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."endereco/form.php?idEndereco=".$idEndereco.$url?>' , '#div_endereco')" >Endereço</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_endereco" class="div_aba_interna">	
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
