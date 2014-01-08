<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idOpcao_itemavaliar = $_REQUEST["idOpcao_itemavaliar"];

$itemAvaliarOral_id = $_REQUEST["itemAvaliarOral_id"];
$url = "&itemAvaliarOral_id=".$itemAvaliarOral_id;
?>

<div id="cadastro_opcao_itemavaliar" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_opcao_itemavaliar" divExibir="div_opcao_itemavaliar" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."opcao_itemavaliar/form.php?idOpcao_itemavaliar=".$idOpcao_itemavaliar.$url?>' , '#div_opcao_itemavaliar')" >Opções de resposta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_opcao_itemavaliar" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
