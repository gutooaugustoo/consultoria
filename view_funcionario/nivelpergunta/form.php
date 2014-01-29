<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$idNivelpergunta = $_REQUEST["idNivelpergunta"];
$Nivelpergunta = new Nivelpergunta($idNivelpergunta);
$nomeTable = "nivelpergunta";
$acao = CAM_VIEW . "nivelpergunta/acao.php";
?>
<fieldset>
	<legend>
		Nível pergunta
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idNivelpergunta" name="idNivelpergunta" value="<?php echo $Nivelpergunta -> get_idNivelpergunta() ?>" />

				<p>
					<label>Nível:</label>
					<input type="text" name="nome" id="nome" value="<?php echo $Nivelpergunta -> get_nomeNivelpergunta()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Nivelpergunta -> get_inativoNivelpergunta())?>
						/>
						Inativo:</label>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>

			<div class="linha-inteira">
				<p>
					<button class="button blue"
					onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
						Enviar
					</button>
				</p>
			</div>
		</form>

	</div>
</fieldset>
<script>ativarForm();</script>
