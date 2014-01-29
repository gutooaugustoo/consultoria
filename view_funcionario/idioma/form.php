<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idIdioma = $_REQUEST["idIdioma"];
$Idioma = new Idioma($idIdioma);
$nomeTable = "idioma";
$acao = CAM_VIEW."idioma/acao.php";
?>
<fieldset>
	<legend>Idioma</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idIdioma" name="idIdioma" value="<?php echo $Idioma -> get_idIdioma() ?>" />
		   									
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Idioma -> get_nomeIdioma()?>" class="required" />
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