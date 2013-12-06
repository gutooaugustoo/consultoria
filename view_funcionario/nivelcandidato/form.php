<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idNivelcandidato = $_REQUEST["idNivelcandidato"];
$Nivelcandidato = new Nivelcandidato($idNivelcandidato);
$nomeTable = "nivelcandidato";
$acao = CAM_VIEW . "nivelcandidato/acao.php";
?>
<fieldset>
	<legend>
		Nível candiaato
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idNivelcandidato" name="idNivelcandidato" value="<?php echo $Nivelcandidato -> get_idNivelcandidato() ?>" />

				<p>
					<label>Nível:</label>
					<input type="text" name="nivel" id="nivel" value="<?php echo $Nivelcandidato -> get_nivelNivelcandidato()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Nivelcandidato -> get_inativoNivelcandidato())?>
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
