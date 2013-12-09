<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idPergunta = $_REQUEST["idPergunta"];
$Pergunta = new Pergunta($idPergunta);
$nomeTable = "pergunta";
$acao = CAM_VIEW."pergunta/acao.php";
?>
<fieldset>
	<legend>Pergunta</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idPergunta" name="idPergunta" value="<?php echo $Pergunta -> get_idPergunta() ?>" />
		
				<p>
				<label>Pergunta:</label>
				<?php $Pergunta = new Pergunta();
				echo $Pergunta -> selectPergunta_html('pergunta_id', $Pergunta -> get_pergunta_idPergunta()); ?>
				<span class="placeholder" ></span></p>
		
				<p>
				<label>Empresa:</label>
				<?php $Empresa = new Empresa();
				echo $Empresa -> selectEmpresa_html('empresa_id', $Pergunta -> get_empresa_idPergunta()); ?>
				<span class="placeholder" ></span></p>
		
				<p>
				<label>ioma:</label>
				<?php $Idioma = new Idioma();
				Html::set_cssClass(array("required"));
				echo $Idioma -> selectIdioma_html('idioma_id', $Pergunta -> get_idioma_idPergunta()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Nivel Pergunta:</label>
				<?php $Nivelpergunta = new Nivelpergunta();
				Html::set_cssClass(array("required"));
				echo $Nivelpergunta -> selectNivelpergunta_html('nivelPergunta_id', $Pergunta -> get_nivelPergunta_idPergunta()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Categoria Pergunta:</label>
				<?php $Categoriapergunta = new Categoriapergunta();
				Html::set_cssClass(array("required"));
				echo $Categoriapergunta -> selectCategoriapergunta_html('categoriaPergunta_id', $Pergunta -> get_categoriaPergunta_idPergunta()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Enunciado:</label>
				<textarea name="enunciado" id="enunciado" cols="60" rows="4" class="required" ><?php echo $Pergunta -> get_enunciadoPergunta()?></textarea>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Tempo Resposta:</label>
				<input type="text" name="tempoResposta" id="tempoResposta" value="<?php echo $Pergunta -> get_tempoRespostaPergunta()?>" class="required numeric" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Pergunta -> get_inativoPergunta())?> />
				Inativo:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>ativarForm();</script> 