<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idCandidato_escrito = $_REQUEST["idCandidato_escrito"];
?>

<div id="cadastro_candidato_escrito" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_candidato_escrito" divExibir="div_candidato_escrito" class="aba_interna ativa" >
			<!--onclick="carregarModulo('<?php echo CAM_VIEW."candidato_escrito/form.php?idCandidato_escrito=".$idCandidato_escrito?>' , '#div_candidato_escrito')"-->
			Avaliação escrita
		</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_candidato_escrito" class="div_aba_interna">
			<fieldset>
				<legend>
					Categoria pergunta
				</legend>
				<p>
					TEXTO EXPLICATIVO SOBRE A PROVA
				</p>

				<button class="button blue"
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
					Iniciar avaliação
				</button>
			</fieldset>
		</div>
	</div>
</div>
