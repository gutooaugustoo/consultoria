<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$idItem_anotacaoentrevista = $_REQUEST["idItem_anotacaoentrevista"];
$Item_anotacaoentrevista = new Item_anotacaoentrevista($idItem_anotacaoentrevista);
$nomeTable = "item_anotacaoentrevista";
$acao = CAM_VIEW . "item_anotacaoentrevista/acao.php";
?>
<fieldset>
	<legend>
		Item para anotar na entrevista
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idItem_anotacaoentrevista" name="idItem_anotacaoentrevista" value="<?php echo $Item_anotacaoentrevista -> get_idItem_anotacaoentrevista() ?>" />

				<p>
					<label>Item:</label>
					<input type="text" name="item" id="item" value="<?php echo $Item_anotacaoentrevista -> get_itemItem_anotacaoentrevista()?>" class="required" />
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
