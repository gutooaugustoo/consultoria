<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idCategoriapergunta = $_REQUEST["idCategoriapergunta"];
$Categoriapergunta = new Categoriapergunta($idCategoriapergunta);
$nomeTable = "categoriapergunta";
$acao = CAM_VIEW . "categoriapergunta/acao.php";
?>
<fieldset>
	<legend>
		Categoria pergunta
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idCategoriapergunta" name="idCategoriapergunta" value="<?php echo $Categoriapergunta -> get_idCategoriapergunta() ?>" />

				<p>
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" value="<?php echo $Categoriapergunta -> get_nomeCategoriapergunta()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Categoriapergunta -> get_inativoCategoriapergunta())?>
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