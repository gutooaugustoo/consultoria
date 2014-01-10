<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Peso_nivel = new Peso_nivel();
if( $idPeso_nivel = $_REQUEST["idPeso_nivel"] ){
  $Peso_nivel->__construct($idPeso_nivel);
}else{
  $Peso_nivel->set_escrito_idPeso_nivel($_REQUEST["escrito_id"]);
}

$nomeTable = "peso_nivel";
$acao = CAM_VIEW."peso_nivel/acao.php";
?>
<fieldset>
	<legend>Peso Nivel</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idPeso_nivel" name="idPeso_nivel" value="<?php echo $Peso_nivel -> get_idPeso_nivel() ?>" />
		    <input type="hidden" id="escrito_id" name="escrito_id" value="<?php echo $Peso_nivel -> get_escrito_idPeso_nivel() ?>" />
								
				<p>
				<label>Nivel da pergunta:</label>
				<?php $Nivelpergunta = new Nivelpergunta();
				Html::set_cssClass(array("required"));
				echo $Nivelpergunta -> selectNivelpergunta_html('nivelPergunta_id', $Peso_nivel -> get_nivelPergunta_idPeso_nivel()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Peso (%):</label>
				<input type="text" name="pesoPorcentagem" id="pesoPorcentagem" value="<?php echo $Peso_nivel -> get_pesoPorcentagemPeso_nivel()?>" class="required percentual" />
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