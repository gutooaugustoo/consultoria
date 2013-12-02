<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPessoa = $_REQUEST["idPessoa"];
$nomeTable = "pessoa";
?>

<div id="cadastro_<?php echo $nomeTable ?>" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_<?php echo $nomeTable ?>" divExibir="div_<?php echo $nomeTable ?>" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."pessoa/_form.php?idPessoa=".$idPessoa?>' , '#div_<?php echo $nomeTable ?>')" >Pessoa</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_<?php echo $nomeTable ?>" class="div_aba_interna">			
			<?php include "_form.php"; ?>						
		</div>
	</div>
</div>
<script>ativarForm();</script> 
