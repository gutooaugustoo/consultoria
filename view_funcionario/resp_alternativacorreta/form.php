<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Resp_alternativacorreta = new Resp_alternativacorreta();
if( $idResp_alternativacorreta = $_REQUEST["idResp_alternativacorreta"] ){
	$Resp_alternativacorreta->__construct($idResp_alternativacorreta);
}else{
	$Resp_alternativacorreta->set_pergunta_idResp_alternativacorreta($_REQUEST["pergunta_id"]);
}

$nomeTable = "resp_alternativacorreta";
$acao = CAM_VIEW."resp_alternativacorreta/acao.php";
?>
<fieldset>
	<legend>Resposta</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idResp_alternativacorreta" name="idResp_alternativacorreta" value="<?php echo $Resp_alternativacorreta -> get_idResp_alternativacorreta() ?>" />
				<input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $Resp_alternativacorreta -> get_pergunta_idResp_alternativacorreta() ?>" />
				
				<?php $idPergunta = $Resp_alternativacorreta -> get_pergunta_idResp_alternativacorreta();
        include_once "../pergunta/_respostas.php";
        ?>
				<p>
				<label>Resposta:</label>
				<input type="text" name="resposta" id="resposta" value="<?php echo $Resp_alternativacorreta -> get_respostaResp_alternativacorreta()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
						
				<p><label for="correta" >
				<input type="checkbox" name="correta" id="correta" value="1" class=""
				<?php echo Uteis::verificaChecked($Resp_alternativacorreta -> get_corretaResp_alternativacorreta())?> />
				Correta:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
					
				<!--<p>
				<label>Ordem:</label>
				<input type="text" name="ordem" id="ordem" value="<?php echo $Resp_alternativacorreta -> get_ordemResp_alternativacorreta()?>" class="required numeric" />
				<span class="placeholder" >Campo obrigatório</span></p>-->
		
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