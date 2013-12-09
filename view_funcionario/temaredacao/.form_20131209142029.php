<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idTemaredacao = $_REQUEST["idTemaredacao"];
$Temaredacao = new Temaredacao($idTemaredacao);
$nomeTable = "temaredacao";
$acao = CAM_VIEW . "temaredacao/acao.php";
?>
<fieldset>
	<legend>
		Tema Redação
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="linha-inteira">

				<input type="hidden" id="idTemaredacao" name="idTemaredacao" value="<?php echo $Temaredacao -> get_idTemaredacao() ?>" />

				<p>
					<label>Tema:</label>
					<textarea name="tema_base" id="tema_base" ><?php echo $Temaredacao -> get_temaTemaredacao()?></textarea>
					<textarea name="tema" id="tema" class="required" ></textarea>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Temaredacao -> get_inativoTemaredacao())?>
						/>
						Inativo:</label>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Obs:</label>
					<textarea name="obs" id="obs" cols="60" rows="4" class="" ><?php echo $Temaredacao -> get_obsTemaredacao()?></textarea>
					<span class="placeholder" ></span>
				</p>

				<p>
					<button class="button blue"
					onclick="postForm_editor('tema', 'formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
						Enviar
					</button>
				</p>
			</div>
		</form>

	</div>
</fieldset>
<script>
	ativarForm();
	viraEditor('tema'); 
</script>
