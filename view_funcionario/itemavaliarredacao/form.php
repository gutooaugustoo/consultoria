<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idItemavaliarredacao = $_REQUEST["idItemavaliarredacao"];
$Itemavaliarredacao = new Itemavaliarredacao($idItemavaliarredacao);
$nomeTable = "itemavaliarredacao";
$acao = CAM_VIEW."itemavaliarredacao/acao.php";
?>
<fieldset>
	<legend>Item a avaliar redação</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idItemavaliarredacao" name="idItemavaliarredacao" value="<?php echo $Itemavaliarredacao -> get_idItemavaliarredacao() ?>" />
		
				<p>
				<label>Item:</label>
				<input type="text" name="enunciado" id="enunciado" value="<?php echo $Itemavaliarredacao -> get_enunciadoItemavaliarredacao()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Dica Como Responder:</label>
				<textarea name="dicaComoResponder" id="dicaComoResponder" cols="60" rows="4" class="" ><?php echo $Itemavaliarredacao -> get_dicaComoResponderItemavaliarredacao()?></textarea>
				<span class="placeholder" ></span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p><label for="padrao" >
				<input type="checkbox" name="padrao" id="padrao" value="1" class=""
				<?php echo Uteis::verificaChecked($Itemavaliarredacao -> get_padraoItemavaliarredacao())?> />
				Padrão (sempre oferecer esse item ao iniciar a montagem de um serviço):</label>
				<span class="placeholder" >Campo obrigatório</span></p>
				
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Itemavaliarredacao -> get_inativoItemavaliarredacao())?> />
				Inativo:</label>
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