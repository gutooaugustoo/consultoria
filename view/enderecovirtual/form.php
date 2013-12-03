<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/admin.php");

$idEnderecovirtual = $_REQUEST["idEnderecovirtual"];
$Enderecovirtual = new Enderecovirtual($idEnderecovirtual);
$nomeTable = "enderecovirtual";
$acao = CAM_VIEW . "enderecovirtual/acao.php";
?>
<fieldset>
	<legend>
		Endereço Virtual
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idEnderecovirtual" name="idEnderecovirtual" value="<?php echo $Enderecovirtual -> get_idEnderecovirtual() ?>" />

				<p>
					<label>Tipo Endereco Virtual:</label>
					<?php $Tipoenderecovirtual = new Tipoenderecovirtual();
						Html::set_cssClass(array("required"));
						echo $Tipoenderecovirtual -> selectTipoenderecovirtual_html('tipoEnderecoVirtual_id', $Enderecovirtual -> get_tipoEnderecoVirtual_idEnderecovirtual());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" value="<?php echo $Enderecovirtual -> get_nomeEnderecovirtual()?>" class="required" />
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
