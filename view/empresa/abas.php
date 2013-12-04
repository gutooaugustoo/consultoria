<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEmpresa = $_REQUEST["idEmpresa"];
?>

<div id="cadastro_empresa" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_empresa" divExibir="div_empresa" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."empresa/form.php?idEmpresa=".$idEmpresa?>' , '#div_empresa')" >Empresa</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_empresa" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
