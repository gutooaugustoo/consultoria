<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$idAvaliador = $_REQUEST["idAvaliador"];
$Pessoa = new Avaliador($idAvaliador);
$nomeTable = "avaliador";
$acao = CAM_VIEW . "avaliador/acao.php";
?>
<fieldset>
	<legend>
		Avaliador
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="idAvaliador" name="idAvaliador" value="<?php echo $Pessoa -> get_idAvaliador() ?>" />

			<?php
			include "../pessoa/form.php";
			?>

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
