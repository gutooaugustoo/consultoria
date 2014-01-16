<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_oral = new Candidato_oral();
if( $idCandidato_oral = $_REQUEST["idCandidato_oral"] ){
  $Candidato_oral->__construct($idCandidato_oral);
}else{
  //$Candidato_oral->set_($_REQUEST[""]);
}

$nomeTable = "candidato_oral";
$acao = CAM_VIEW."candidato_oral/acao.php";
?>
<fieldset>
	<legend>Candato Oral</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idCandidato_oral" name="idCandidato_oral" value="<?php echo $Candidato_oral -> get_idCandidato_oral() ?>" />
		
				<p>
				<label>Servico Candato:</label>
				<?php $Servico_candidato = new Servico_candidato();
				Html::set_cssClass(array("required"));
				echo $Servico_candidato -> selectServico_candidato_html('servico_candidato_id', $Candidato_oral -> get_servico_candidato_idCandidato_oral()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Servico Avaliador:</label>
				<?php $Servico_avaliador = new Servico_avaliador();
				Html::set_cssClass(array("required"));
				echo $Servico_avaliador -> selectServico_avaliador_html('servico_avaliador_id', $Candidato_oral -> get_servico_avaliador_idCandidato_oral()); ?>
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