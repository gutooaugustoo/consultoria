<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Backgroundidioma = new Backgroundidioma();

if ($idBackgroundidioma = $_REQUEST["idBackgroundidioma"]) {
	$Backgroundidioma -> __construct($idBackgroundidioma);
} else {
	$Backgroundidioma -> set_candidato_idBackgroundidioma($_REQUEST["pessoa_id"]);
}

$nomeTable = "backgroundidioma";
$acao = CAM_VIEW . "backgroundidioma/acao.php";
?>
<fieldset>
	<legend>
		Background no idioma
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idBackgroundidioma" name="idBackgroundidioma" value="<?php echo $Backgroundidioma -> get_idBackgroundidioma() ?>" />

				<input type="hidden" id="candidato_id" name="candidato_id" value="<?php echo $Backgroundidioma -> get_candidato_idBackgroundidioma() ?>" />

				<p>
					<label>Escola:</label>
					<?php $Escola = new Escola();
						Html::set_cssClass(array("required"));
						echo $Escola -> selectEscola_html('escola_id', $Backgroundidioma -> get_escola_idBackgroundidioma());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Idioma:</label>
					<?php $Idioma = new Idioma();
						Html::set_cssClass(array("required"));
						echo $Idioma -> selectIdioma_html('idioma_id', $Backgroundidioma -> get_idioma_idBackgroundidioma());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>
				<p>
					<label>Há quanto tempo estudou:</label>
					<input type="text" name="haQuantoTempo" id="haQuantoTempo" value="<?php echo $Backgroundidioma -> get_haQuantoTempoBackgroundidioma()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>
				<p>
					<label>Durante quanto tempo estudou:</label>
					<input type="text" name="quantoTempo" id="quantoTempo" value="<?php echo $Backgroundidioma -> get_quantoTempoBackgroundidioma()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>
			</div>

			<div class="direita">

				<p>
					<label>Obs:</label>
					<textarea name="obs" id="obs" cols="60" rows="4" class="" ><?php echo $Backgroundidioma -> get_obsBackgroundidioma()?></textarea>
					<span class="placeholder" ></span>
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
