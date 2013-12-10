<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

if ($idPergunta = $_REQUEST["idPergunta"]) {
	$Pergunta -> __construct($idPergunta);
	$tipoPergunta_id = $Pergunta -> get_tipoPergunta_idPergunta();
} else {
	$tipoPergunta_id = $_REQUEST['tipoPergunta_id'];
}

$Tipopergunta = new Tipopergunta($tipoPergunta_id);
$url = "&tipoPergunta_id=" . $tipoPergunta_id;

$nomeTable = "pergunta";
$acao = CAM_VIEW . "pergunta/acao.php";
?>
<fieldset>
	<legend>Pergunta - <?php echo $Tipopergunta -> get_descricaoTipopergunta(); ?></legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  <input type="hidden" id="tipoPergunta_id" name="tipoPergunta_id" value="<?php echo $tipoPergunta_id?>" />
		  
		  <?php if( $tipoPergunta_id == "4" ){?>		
		  	
		  <?php }?>
		  		
		  <div class="linha-inteira">
		  	
		  	<p>					  	
					<label>Enunciado:</label>
					<input type="text" name="titulo" id="titulo" value="<?php echo $Pergunta -> get_tituloPergunta()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>
						
				<p><label>Complemento da questão:</label>	
					<textarea name="enunciado_base" id="enunciado_base" cols="100" rows="8" ><?php echo $Pergunta -> get_enunciadoPergunta()?></textarea>
					<textarea name="enunciado" id="enunciado" class="<?php echo ( $tipoPergunta_id == "4" ) ? "required" : ""?>" ></textarea>
					<span class="placeholder" >Campo obrigatório</span>								
				</p>
			</div>	
			
			<div class="esquerda">

				<input type="hidden" id="idPergunta" name="idPergunta" value="<?php echo $Pergunta -> get_idPergunta() ?>" />
				<p>
					<label>Idioma (em que está escrita a pergunta):</label>
					<?php $Idioma = new Idioma();
						Html::set_cssClass(array("required"));
						echo $Idioma -> selectIdioma_html('idioma_id', $Pergunta -> get_idioma_idPergunta());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Nível Pergunta:</label>
					<?php $Nivelpergunta = new Nivelpergunta();
						Html::set_cssClass(array("required"));
						echo $Nivelpergunta -> selectNivelpergunta_html('nivelPergunta_id', $Pergunta -> get_nivelPergunta_idPergunta());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>
				<p>
					<label>Categoria Pergunta:</label>
					<?php $Categoriapergunta = new Categoriapergunta();
						Html::set_cssClass(array("required"));
						echo $Categoriapergunta -> selectCategoriapergunta_html('categoriaPergunta_id', $Pergunta -> get_categoriaPergunta_idPergunta());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>
			</div>

			<div class="direita">

				<p>
					<label>Tempo para responder (em segundos):</label>
					<input type="text" name="tempoResposta" id="tempoResposta" value="<?php echo $Pergunta -> get_tempoRespostaPergunta()?>" class="required numeric" maxlength="3" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Exclusiva para a empresa (deixe em branco caso não seja exclusiva):</label>
					<?php $Empresa = new Empresa();
						echo $Empresa -> selectEmpresa_html('empresa_id', $Pergunta -> get_empresa_idPergunta());
					?>
					<span class="placeholder" ></span>
				</p>

				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Pergunta -> get_inativoPergunta())?>
						/>
						Inativo:</label>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm_editor('enunciado', 'formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>

<script>
	ativarForm();
	<?php if( $tipoPergunta_id == "4" ){?>		
		viraEditor_lacuna('enunciado');
	<?php }else{?>		
		viraEditor('enunciado');
	<?php }?>		
</script> 