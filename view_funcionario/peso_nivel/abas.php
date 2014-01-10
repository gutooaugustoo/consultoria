<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idPeso_nivel = $_REQUEST["idPeso_nivel"];

$escrito_id = $_REQUEST["escrito_id"];
$url = "&escrito_id=".$escrito_id;
?>

<div id="cadastro_peso_nivel" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_peso_nivel" divExibir="div_peso_nivel" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."peso_nivel/form.php?idPeso_nivel=".$idPeso_nivel.$url?>' , '#div_peso_nivel')" >Peso do teste</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_peso_nivel" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
