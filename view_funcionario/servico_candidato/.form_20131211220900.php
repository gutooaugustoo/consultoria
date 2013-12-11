<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico_candidato = $_REQUEST["idServico_candidato"];
$Servico_candidato = new Servico_candidato($idServico_candidato);
$nomeTable = "servico_candidato";
$acao = CAM_VIEW."servico_candidato/acao.php";
?>
<fieldset>
	<legend>Servico Candato</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico_candidato" name="idServico_candidato" value="<?php echo $Servico_candidato -> get_idServico_candidato() ?>" />
		
				<p>
				<label>Servico:</label>
				<?php $Servico = new Servico();
				Html::set_cssClass(array("required"));
				echo $Servico -> selectServico_html('servico_id', $Servico_candidato -> get_servico_idServico_candidato()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Candato:</label>
				<?php $Candidato = new Candidato();
				Html::set_cssClass(array("required"));
				echo $Candidato -> selectCandidato_html('candidato_id', $Servico_candidato -> get_candidato_idServico_candidato()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Data Valade:</label>
				<input type="text" name="dataValidade" id="dataValidade" value="<?php echo $Servico_candidato -> get_dataValidadeServico_candidato()?>" class="required data" />
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