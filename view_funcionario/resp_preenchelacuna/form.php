<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Resp_preenchelacuna = new Resp_preenchelacuna();
if ($idResp_preenchelacuna = $_REQUEST["idResp_preenchelacuna"]) {
  $Resp_preenchelacuna -> __construct($idResp_preenchelacuna);
} else {
  $Resp_preenchelacuna -> set_pergunta_idResp_preenchelacuna($_REQUEST["pergunta_id"]);
  $Resp_preenchelacuna -> set_ordemResp_preenchelacuna($Resp_preenchelacuna -> get_proximaOrdem());
}

$nomeTable = "resp_preenchelacuna";
$acao = CAM_VIEW . "resp_preenchelacuna/acao.php";
?>
<fieldset>
	<legend>
		Editar lacuna
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="linha-inteira">

				<input type="hidden" id="idResp_preenchelacuna" name="idResp_preenchelacuna" value="<?php echo $Resp_preenchelacuna -> get_idResp_preenchelacuna() ?>" />
				<input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $Resp_preenchelacuna -> get_pergunta_idResp_preenchelacuna() ?>" />

				<p>
					<label>Ordem:</label>
					<?php echo $Resp_preenchelacuna -> get_ordemResp_preenchelacuna()
					?>
					<input type="hidden" name="ordem_respLacuna" id="ordem_respLacuna" value="<?php echo $Resp_preenchelacuna -> get_ordemResp_preenchelacuna()?>" class="" />
				</p>

				<p>
					<label>Selecione a(s) palavra(s) que será(ão) a lacuna e clique no botão "Definir lacuna":</label>
					<!--<div id="div_enunciado"><?php echo $Pergunta -> get_enunciadoPergunta()?></div>-->
					<textarea name="enunciado_base" id="enunciado_base" class="" >
					<?php $Pergunta = new Pergunta( $Resp_preenchelacuna -> get_pergunta_idResp_preenchelacuna() ); 
					echo $Pergunta -> get_enunciadoPergunta()?></textarea>
					<textarea name="enunciado" id="enunciado" class="required"></textarea>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Lacuna:</label>
					<input type="text" name="lacuna_respLacuna" id="lacuna_respLacuna" value="<?php echo $Resp_preenchelacuna -> get_lacunaResp_preenchelacuna()?>" class="required" readonly  />
					<span class="placeholder" >Campo obrigatório (não digite aqui)</span>
				</p>

			</div>

			<div class="linha-inteira">
				<p>
					<button class="button blue"
					onclick="postForm_editor('enunciado', 'formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
						Enviar
					</button>
				</p>
			</div>
		</form>

	</div>
</fieldset>
<script>
	ativarForm();
	viraEditor_lacuna('enunciado'); 
</script>
