<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Servico_gestor = new Servico_gestor();
if( $idServico_gestor = $_REQUEST["idServico_gestor"] ){
  $Servico_gestor->__construct($idServico_gestor);
}else{
  $Servico_gestor->set_servico_idServico_gestor($_REQUEST["servico_id"]);  
}

$nomeTable = "servico_gestor";
$acao = CAM_VIEW."servico_gestor/acao.php";
?>
<fieldset>
	<legend>Gestor vínculado ao serviço</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico_gestor" name="idServico_gestor" value="<?php echo $Servico_gestor -> get_idServico_gestor() ?>" />
				<input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Servico_gestor -> get_servico_idServico_gestor() ?>" />
						
				<p>
				<label>Gestor:</label>
				<?php
        $Servico = new Servico( $Servico_gestor->get_servico_idServico_gestor() );        
        $where = " WHERE G.empresa_id = ".$Servico->get_empresa_idServico();        
				Html::set_cssClass(array("required"));
        $Gestor = new Gestor();
				echo $Gestor -> selectGestor_html('gestor_id', $Servico_gestor -> get_gestor_idServico_gestor(), $where); ?>
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