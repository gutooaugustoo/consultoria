<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEstadocivil = $_REQUEST["idEstadocivil"];
$Estadocivil = new Estadocivil($idEstadocivil);
$nomeTable = "estadocivil";
$acao = CAM_VIEW."estadocivil/acao.php";
?>
<fieldset>
	<legend>Estadocivil</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEstadocivil" name="idEstadocivil" value="<?php echo $Estadocivil -> get_idEstadocivil() ?>" />
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Estadocivil -> get_nomeEstadocivil()?>" class="required" />
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