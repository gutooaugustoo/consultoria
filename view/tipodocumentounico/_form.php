<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTipodocumentounico = $_REQUEST["idTipodocumentounico"];
$Tipodocumentounico = new Tipodocumentounico($idTipodocumentounico);
$nomeTable = "tipodocumentounico";
$acao = CAM_VIEW."tipodocumentounico/acao.php";
?>
<fieldset>
	<legend>Tipodocumentounico</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idTipodocumentounico" name="idTipodocumentounico" value="<?php echo $Tipodocumentounico -> get_idTipodocumentounico() ?>" />
		
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Tipodocumentounico -> get_nomeTipodocumentounico()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Class:</label>
				<input type="text" name="class" id="class" value="<?php echo $Tipodocumentounico -> get_classTipodocumentounico()?>" class="required" />
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