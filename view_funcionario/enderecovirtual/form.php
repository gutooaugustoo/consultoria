<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$Enderecovirtual = new Enderecovirtual();

if ($idEnderecovirtual = $_REQUEST["idEnderecovirtual"]) {
	$Enderecovirtual -> __construct($idEnderecovirtual);
} else {
	$Enderecovirtual -> set_pessoa_idEnderecovirtual($_REQUEST["pessoa_id"]);
	$Enderecovirtual -> set_empresa_idEnderecovirtual($_REQUEST["empresa_id"]);
}

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

				<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $Enderecovirtual -> get_pessoa_idEnderecovirtual() ?>" />
				<input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $Enderecovirtual ->get_empresa_idEnderecovirtual() ?>" />

				<p>
					<label>Tipo:</label>
					<?php $Tipoenderecovirtual = new Tipoenderecovirtual();
						Html::set_cssClass(array("required"));
						Html::set_eventos(array("onchange" => "carregarMascara();"));
						echo $Tipoenderecovirtual -> selectTipoenderecovirtual_html('tipoEnderecoVirtual_id', $Enderecovirtual -> get_tipoEnderecoVirtual_idEnderecovirtual());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Endereço Virtual:</label>
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
<script>ativarForm();
	
function carregarMascara(){
	var o = $('#formCad_<?php echo $nomeTable ?> #tipoEnderecoVirtual_id');
	var nome = $('#formCad_<?php echo $nomeTable ?> #nome');
	if( o.val() == 1 ){
		nome.addClass("email");
	}else{
		nome.removeClass("email");
	}
}
carregarMascara();
</script>
