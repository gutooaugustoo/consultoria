<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta_randomica = new Escrito_pergunta_randomica();
if( $idEscrito_pergunta_randomica = $_REQUEST["idEscrito_pergunta_randomica"] ){
  $Escrito_pergunta_randomica->__construct($idEscrito_pergunta_randomica);
}else{
  //$Escrito_pergunta_randomica->set_($_REQUEST[""]);
}

$nomeTable = "escrito_pergunta_randomica";
$acao = CAM_VIEW."escrito_pergunta_randomica/acao.php";
?>
<fieldset>
	<legend>Escrito Pergunta Randomica</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEscrito_pergunta_randomica" name="idEscrito_pergunta_randomica" value="<?php echo $Escrito_pergunta_randomica -> get_idEscrito_pergunta_randomica() ?>" />
		
				<p>
				<label>Escrito:</label>
				<?php $Escrito = new Escrito();
				Html::set_cssClass(array("required"));
				echo $Escrito -> selectEscrito_html('escrito_id', $Escrito_pergunta_randomica -> get_escrito_idEscrito_pergunta_randomica()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Nivel Pergunta:</label>
				<?php $Nivelpergunta = new Nivelpergunta();
				Html::set_cssClass(array("required"));
				echo $Nivelpergunta -> selectNivelpergunta_html('nivelPergunta_id', $Escrito_pergunta_randomica -> get_nivelPergunta_idEscrito_pergunta_randomica()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Categoria Pergunta:</label>
				<?php $Categoriapergunta = new Categoriapergunta();
				Html::set_cssClass(array("required"));
				echo $Categoriapergunta -> selectCategoriapergunta_html('categoriaPergunta_id', $Escrito_pergunta_randomica -> get_categoriaPergunta_idEscrito_pergunta_randomica()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>ioma:</label>
				<?php $Idioma = new Idioma();
				Html::set_cssClass(array("required"));
				echo $Idioma -> selectIdioma_html('idioma_id', $Escrito_pergunta_randomica -> get_idioma_idEscrito_pergunta_randomica()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Quantade:</label>
				<input type="text" name="quantidade" id="quantidade" value="<?php echo $Escrito_pergunta_randomica -> get_quantidadeEscrito_pergunta_randomica()?>" class="required numeric" />
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