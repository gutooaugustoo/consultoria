<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idDicasentrevista = $_REQUEST["idDicasentrevista"];
$Dicasentrevista = new Dicasentrevista($idDicasentrevista);
$nomeTable = "dicasentrevista";
$acao = CAM_VIEW . "dicasentrevista/acao.php";
?>
<fieldset>
	<legend>
		Dicas de entrevista
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idDicasentrevista" name="idDicasentrevista" value="<?php echo $Dicasentrevista -> get_idDicasentrevista() ?>" />

				<p>
					<label>Idioma:</label>
					<?php $Idioma = new Idioma();
						Html::set_cssClass(array("required"));
						echo $Idioma -> selectIdioma_html('idioma_id', $Dicasentrevista -> get_idioma_idDicasentrevista());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Titulo:</label>
					<input type="text" name="titulo" id="titulo" value="<?php echo $Dicasentrevista -> get_tituloDicasentrevista()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>

			<div class="direita">

				<p>
					<label>Dica:</label>
					<textarea name="dica" id="dica" cols="100" rows="10" class="required" ><?php echo $Dicasentrevista -> get_dicaDicasentrevista()?></textarea>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Dicasentrevista -> get_inativoDicasentrevista())?>
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
