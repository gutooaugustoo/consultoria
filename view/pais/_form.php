<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPais = $_REQUEST["idPais"];
$Pais = new Pais($idPais);
$nomeTable = "pais";
$acao = CAM_VIEW."pais/acao.php";
?>
<fieldset>
	<legend>Pais</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idPais" name="idPais" value="<?php echo $Pais -> get_idPais() ?>" />
		
				<p>
				<label>Nacionalade:</label>
				<input type="text" name="nacionalidade" id="nacionalidade" value="<?php echo $Pais -> get_nacionalidadePais()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Pais:</label>
				<input type="text" name="pais" id="pais" value="<?php echo $Pais -> get_paisPais()?>" class="required" />
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