<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Resp_verdadeirofalso = new Resp_verdadeirofalso();

if( $idResp_verdadeirofalso = $_REQUEST["idResp_verdadeirofalso"] ){
	$Resp_verdadeirofalso->__construct($idResp_verdadeirofalso);
}else{
	$Resp_verdadeirofalso->set_pergunta_idResp_verdadeirofalso($_REQUEST["pergunta_id"]);
}

$nomeTable = "resp_verdadeirofalso";
$acao = CAM_VIEW."resp_verdadeirofalso/acao.php";
?>
<fieldset>
	<legend>Resposta</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idResp_verdadeirofalso" name="idResp_verdadeirofalso" value="<?php echo $Resp_verdadeirofalso -> get_idResp_verdadeirofalso() ?>" />
				<input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $Resp_verdadeirofalso -> get_pergunta_idResp_verdadeirofalso() ?>" />
				
				<p>
				<label>Resposta:</label>
				<input type="text" name="resposta" id="resposta" value="<?php echo $Resp_verdadeirofalso -> get_respostaResp_verdadeirofalso()?>" class="required textoGrande"  />
				<span class="placeholder" >Campo obrigatório</span></p>
						
				<!--<p>
				<label>Ordem:</label>
				<input type="text" name="ordem" id="ordem" value="<?php echo $Resp_verdadeirofalso -> get_ordemResp_verdadeirofalso()?>" class="numeric" />
				<span class="placeholder" ></span></p>-->		   	
				
				<p><label for="verdadeiroFalso" >
				<input type="checkbox" name="verdadeiroFalso" id="verdadeiroFalso" value="1" class=""
				<?php echo Uteis::verificaChecked($Resp_verdadeirofalso -> get_verdadeiroFalsoResp_verdadeirofalso())?> />
				Verdadeiro (se não marcar a resposta é falsa):</label>
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