<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico_gestor = $_REQUEST["idServico_gestor"];
$Servico_gestor = new Servico_gestor($idServico_gestor);
$nomeTable = "servico_gestor";
$acao = CAM_VIEW."servico_gestor/acao.php";
?>
<fieldset>
	<legend>Servico Gestor</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico_gestor" name="idServico_gestor" value="<?php echo $Servico_gestor -> get_idServico_gestor() ?>" />
		
				<p>
				<label>Servico:</label>
				<?php $Servico = new Servico();
				Html::set_cssClass(array("required"));
				echo $Servico -> selectServico_html('servico_id', $Servico_gestor -> get_servico_idServico_gestor()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Gestor:</label>
				<?php $Gestor = new Gestor();
				Html::set_cssClass(array("required"));
				echo $Gestor -> selectGestor_html('gestor_id', $Servico_gestor -> get_gestor_idServico_gestor()); ?>
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