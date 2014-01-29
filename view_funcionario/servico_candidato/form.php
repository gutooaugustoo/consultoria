<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico_candidato = new Servico_candidato();
if ($idServico_candidato = $_REQUEST["idServico_candidato"]) {
  $Servico_candidato -> __construct($idServico_candidato);
} else {
  $Servico_candidato -> set_servico_idServico_candidato($_REQUEST["servico_id"]);
  
  $Servico = new Servico($Servico_candidato -> get_servico_idServico_candidato());
  $Servico_candidato->set_dataValidadeServico_candidato( $Servico->get_dataValidadeServico() );
}


$nomeTable = "servico_candidato";
$acao = CAM_VIEW."servico_candidato/acao.php";
?>
<fieldset>
	<legend>Candidato vínculado ao serviço</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico_candidato" name="idServico_candidato" value="<?php echo $Servico_candidato -> get_idServico_candidato() ?>" />
				<input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Servico_candidato -> get_servico_idServico_candidato() ?>" />
				
				<p>
				<label>Candidato:</label>
				<?php $Candidato = new Candidato();
				Html::set_cssClass(array("required"));
				echo $Candidato -> selectCandidato_html('candidato_id', $Servico_candidato -> get_candidato_idServico_candidato()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Data Validade:</label>							
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