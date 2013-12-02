<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTipodocumentounico = $_REQUEST["idTipodocumentounico"];
$nomeTable = "tipodocumentounico";
?>

<div id="cadastro_<?php echo $nomeTable ?>" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_<?php echo $nomeTable ?>" divExibir="div_<?php echo $nomeTable ?>" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."tipodocumentounico/_form.php?idTipodocumentounico=".$idTipodocumentounico?>' , '#div_<?php echo $nomeTable ?>')" >Tipodocumentounico</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_<?php echo $nomeTable ?>" class="div_aba_interna">			
			<?php include "_form.php"; ?>						
		</div>
	</div>
</div>
<script>ativarForm();</script> 
