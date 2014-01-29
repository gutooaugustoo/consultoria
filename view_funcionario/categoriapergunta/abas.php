<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idCategoriapergunta = $_REQUEST["idCategoriapergunta"];
?>

<div id="cadastro_categoriapergunta" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_categoriapergunta" divExibir="div_categoriapergunta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."categoriapergunta/form.php?idCategoriapergunta=".$idCategoriapergunta?>' , '#div_categoriapergunta')" >Categoria pergunta</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_categoriapergunta" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
