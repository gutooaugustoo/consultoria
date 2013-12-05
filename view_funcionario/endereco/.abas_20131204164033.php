<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idEndereco = $_REQUEST["idEndereco"];
?>

<div id="cadastro_endereco" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_endereco" divExibir="div_endereco" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."endereco/form.php?idEndereco=".$idEndereco?>' , '#div_endereco')" >Endereco</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_endereco" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
