<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico_avaliador = $_REQUEST["idServico_avaliador"];
$Servico_avaliador = new Servico_avaliador($idServico_avaliador);
$nomeTable = "servico_avaliador";
$acao = CAM_VIEW."servico_avaliador/acao.php";
?>
<fieldset>
	<legend>Servico Avaliador</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico_avaliador" name="idServico_avaliador" value="<?php echo $Servico_avaliador -> get_idServico_avaliador() ?>" />
		
				<p>
				<label>Servico:</label>
				<?php $Servico = new Servico();
				Html::set_cssClass(array("required"));
				echo $Servico -> selectServico_html('servico_id', $Servico_avaliador -> get_servico_idServico_avaliador()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Avaliador:</label>
				<?php $Avaliador = new Avaliador();
				Html::set_cssClass(array("required"));
				echo $Avaliador -> selectAvaliador_html('avaliador_id', $Servico_avaliador -> get_avaliador_idServico_avaliador()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
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