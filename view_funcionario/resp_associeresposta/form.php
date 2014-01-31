<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Resp_associeresposta = new Resp_associeresposta();

if( $idResp_associeresposta = $_REQUEST["idResp_associeresposta"] ){
	$Resp_associeresposta->__construct($idResp_associeresposta);
}else{
	$Resp_associeresposta->set_pergunta_idResp_associeresposta($_REQUEST["pergunta_id"]);
}

$nomeTable = "resp_associeresposta";
$acao = CAM_VIEW."resp_associeresposta/acao.php";
?>
<fieldset>
	<legend>Respostas</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="linha-inteira">		  					
				
				<input type="hidden" id="idResp_associeresposta" name="idResp_associeresposta" value="<?php echo $Resp_associeresposta -> get_idResp_associeresposta() ?>" />
				<input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $Resp_associeresposta -> get_pergunta_idResp_associeresposta() ?>" />
				
				<?php $idPergunta = $Resp_associeresposta -> get_pergunta_idResp_associeresposta();
        include_once "../pergunta/_respostas.php";
        ?>
        
				<!--<p>
				<label>Ordem:</label>
				<input type="text" name="ordem" id="ordem" value="<?php echo $Resp_associeresposta -> get_ordemResp_associeresposta()?>" class="numeric" />
				<span class="placeholder" ></span></p>-->
        
               	   				
				<p>
				<label>Opção original:</label>
				<input type="text" name="descPergunta" id="descPergunta" value="<?php echo $Resp_associeresposta -> get_descPerguntaResp_associeresposta()?>" class="required textoGrande" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Opção associada:</label>
				<input type="text" name="descResposta" id="descResposta" value="<?php echo $Resp_associeresposta -> get_descRespostaResp_associeresposta()?>" class="required textoGrande" />
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