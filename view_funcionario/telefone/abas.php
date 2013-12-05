<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idTelefone = $_REQUEST["idTelefone"];

$pessoa_id = $_REQUEST["pessoa_id"];
$empresa_id = $_REQUEST["empresa_id"];
$url = "&pessoa_id=".$pessoa_id."&empresa_id=".$empresa_id;
?>

<div id="cadastro_telefone" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_telefone" divExibir="div_telefone" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."telefone/form.php?idTelefone=".$idTelefone.$url?>' , '#div_telefone')" >Telefone</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_telefone" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
