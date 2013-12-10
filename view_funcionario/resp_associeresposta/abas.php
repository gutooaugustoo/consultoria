<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idResp_associeresposta = $_REQUEST["idResp_associeresposta"];

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "&pergunta_id=".$pergunta_id;
?>

<div id="cadastro_resp_associeresposta" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_resp_associeresposta" divExibir="div_resp_associeresposta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."resp_associeresposta/form.php?idResp_associeresposta=".$idResp_associeresposta.$url?>' , '#div_resp_associeresposta')" >Resp Associeresposta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_resp_associeresposta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
