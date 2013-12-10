<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idResp_alternativacorreta = $_REQUEST["idResp_alternativacorreta"];

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "&pergunta_id=".$pergunta_id;
?>

<div id="cadastro_resp_alternativacorreta" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_resp_alternativacorreta" divExibir="div_resp_alternativacorreta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."resp_alternativacorreta/form.php?idResp_alternativacorreta=".$idResp_alternativacorreta.$url?>' , '#div_resp_alternativacorreta')" >Resposta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_resp_alternativacorreta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
