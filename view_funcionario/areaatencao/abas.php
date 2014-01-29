
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idAreaatencao = $_REQUEST["idAreaatencao"];
?>

<div id="cadastro_areaatencao" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_areaatencao" divExibir="div_areaatencao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."areaatencao/form.php?idAreaatencao=".$idAreaatencao?>' , '#div_areaatencao')" >Qualidade da comunicação</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_areaatencao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
