<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idResp_verdadeirofalso = $_REQUEST["idResp_verdadeirofalso"];

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "&pergunta_id=".$pergunta_id;
?>

<div id="cadastro_resp_verdadeirofalso" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_resp_verdadeirofalso" divExibir="div_resp_verdadeirofalso" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."resp_verdadeirofalso/form.php?idResp_verdadeirofalso=".$idResp_verdadeirofalso.$url?>' , '#div_resp_verdadeirofalso')" >Resposta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_resp_verdadeirofalso" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
