<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito_pergunta = new Escrito_pergunta();
if( $idEscrito_pergunta = $_REQUEST["idEscrito_pergunta"] ){
  $Escrito_pergunta->__construct($idEscrito_pergunta);
}else{
  //$Escrito_pergunta->set_($_REQUEST[""]);
}

$nomeTable = "escrito_pergunta";
$acao = CAM_VIEW."escrito_pergunta/acao.php";
?>
<fieldset>
	<legend>Escrito Pergunta</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEscrito_pergunta" name="idEscrito_pergunta" value="<?php echo $Escrito_pergunta -> get_idEscrito_pergunta() ?>" />
		
				<p>
				<label>Escrito:</label>
				<?php $Escrito = new Escrito();
				Html::set_cssClass(array("required"));
				echo $Escrito -> selectEscrito_html('escrito_id', $Escrito_pergunta -> get_escrito_idEscrito_pergunta()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Pergunta:</label>
				<?php $Pergunta = new Pergunta();
				Html::set_cssClass(array("required"));
				echo $Pergunta -> selectPergunta_html('pergunta_id', $Escrito_pergunta -> get_pergunta_idEscrito_pergunta()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Ordem:</label>
				<input type="text" name="ordem" id="ordem" value="<?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta()?>" class="required numeric" />
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