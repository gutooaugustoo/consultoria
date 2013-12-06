<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idTipoenderecovirtual = $_REQUEST["idTipoenderecovirtual"];
$Tipoenderecovirtual = new Tipoenderecovirtual($idTipoenderecovirtual);
$nomeTable = "tipoenderecovirtual";
$acao = CAM_VIEW . "tipoenderecovirtual/acao.php";
?>
<fieldset>
	<legend>
		Tipo de endereço virtual
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idTipoenderecovirtual" name="idTipoenderecovirtual" value="<?php echo $Tipoenderecovirtual -> get_idTipoenderecovirtual() ?>" />

				<p>
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" value="<?php echo $Tipoenderecovirtual -> get_nomeTipoenderecovirtual()?>" class="required" />
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
