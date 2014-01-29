<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idItemavaliaroral = $_REQUEST["idItemavaliaroral"];
$Itemavaliaroral = new Itemavaliaroral($idItemavaliaroral);
$nomeTable = "itemavaliaroral";
$acao = CAM_VIEW."itemavaliaroral/acao.php";
?>
<fieldset>
	<legend>Item a avaliar teste oral</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idItemavaliaroral" name="idItemavaliaroral" value="<?php echo $Itemavaliaroral -> get_idItemavaliaroral() ?>" />
		
				<p>
				<label>Enunciado:</label>
				<input type="text" name="enunciado" id="enunciado" value="<?php echo $Itemavaliaroral -> get_enunciadoItemavaliaroral()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Dica Como Responder:</label>
				<textarea name="dicaComoResponder" id="dicaComoResponder" cols="60" rows="4" class="" ><?php echo $Itemavaliaroral -> get_dicaComoResponderItemavaliaroral()?></textarea>
				<span class="placeholder" ></span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p><label for="padrao" >
				<input type="checkbox" name="padrao" id="padrao" value="1" class=""
				<?php echo Uteis::verificaChecked($Itemavaliaroral -> get_padraoItemavaliaroral())?> />
				Padrao:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Itemavaliaroral -> get_inativoItemavaliaroral())?> />
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