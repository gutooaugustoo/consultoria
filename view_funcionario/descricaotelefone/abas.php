<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idDescricaotelefone = $_REQUEST["idDescricaotelefone"];
?>

<div id="cadastro_descricaotelefone" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_descricaotelefone" divExibir="div_descricaotelefone" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."descricaotelefone/form.php?idDescricaotelefone=".$idDescricaotelefone?>' , '#div_descricaotelefone')" >Descrição telefone</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_descricaotelefone" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
