<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Candidato_escrito = new Candidato_escrito();
if( $idCandidato_escrito = $_REQUEST["idCandidato_escrito"] ){
  $Candidato_escrito->__construct($idCandidato_escrito);
}else{
  //$Candidato_escrito->set_($_REQUEST[""]);
}

$nomeTable = "candidato_escrito";
$acao = CAM_VIEW."candidato_escrito/acao.php";
?>
<fieldset>
	<legend>Candato Escrito</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idCandidato_escrito" name="idCandidato_escrito" value="<?php echo $Candidato_escrito -> get_idCandidato_escrito() ?>" />
		
				<p>
				<label>Escrito:</label>
				<?php $Escrito = new Escrito();
				Html::set_cssClass(array("required"));
				echo $Escrito -> selectEscrito_html('escrito_id', $Candidato_escrito -> get_escrito_idCandidato_escrito()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Servico Candato:</label>
				<?php $Servico_candidato = new Servico_candidato();
				Html::set_cssClass(array("required"));
				echo $Servico_candidato -> selectServico_candidato_html('servico_candidato_id', $Candidato_escrito -> get_servico_candidato_idCandidato_escrito()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Servico Avaliador:</label>
				<?php $Servico_avaliador = new Servico_avaliador();
				echo $Servico_avaliador -> selectServico_avaliador_html('servico_avaliador_id', $Candidato_escrito -> get_servico_avaliador_idCandidato_escrito()); ?>
				<span class="placeholder" ></span></p>
		
				<p><label for="finalizado" >
				<input type="checkbox" name="finalizado" id="finalizado" value="1" class=""
				<?php echo Uteis::verificaChecked($Candidato_escrito -> get_finalizadoCandidato_escrito())?> />
				Finalizado</label>
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