<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Opcao_itemavaliar = new Opcao_itemavaliar();

if( $idOpcao_itemavaliar = $_REQUEST["idOpcao_itemavaliar"] ){
	$Opcao_itemavaliar->__construct($idOpcao_itemavaliar);
}else{	
	$Opcao_itemavaliar->set_itemAvaliarOral_idOpcao_itemavaliar($_REQUEST["itemAvaliarOral_id"]);
}

$nomeTable = "opcao_itemavaliar";
$acao = CAM_VIEW . "opcao_itemavaliar/acao.php";
?>
<fieldset>
	<legend>
		Opções de resposta
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idOpcao_itemavaliar" name="idOpcao_itemavaliar" value="<?php echo $Opcao_itemavaliar -> get_idOpcao_itemavaliar() ?>" />

				<input type="hidden" id="itemAvaliarOral_id" name="itemAvaliarOral_id" value="<?php echo $Opcao_itemavaliar -> get_itemAvaliarOral_idOpcao_itemavaliar() ?>" />

				<p>
					<label>Opção:</label>
					<input type="text" name="opcao" id="opcao" value="<?php echo $Opcao_itemavaliar -> get_opcaoOpcao_itemavaliar()?>" class="required" />
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
