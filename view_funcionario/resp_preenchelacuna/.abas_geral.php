<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idResp_preenchelacuna = $_REQUEST["idResp_preenchelacuna"];

$pergunta_id = $_REQUEST['pergunta_id'];
$url = "&pergunta_id=".$pergunta_id;
?>

<div id="cadastro_resp_preenchelacuna" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_resp_preenchelacuna" divExibir="div_resp_preenchelacuna" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."resp_preenchelacuna/form_geral.php?".$url?>' , '#div_resp_preenchelacuna')" >Montar lacunas</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_resp_preenchelacuna" class="div_aba_interna">			
			<?php include "form_geral.php"; ?>						
		</div>
	</div>
</div>
