<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Local_oral = new Local_oral();
if( $idLocal_oral = $_REQUEST["idLocal_oral"] ){
  $Local_oral->__construct($idLocal_oral);
}else{
  //$Local_oral->set_($_REQUEST[""]);
}

$nomeTable = "local_oral";
$acao = CAM_VIEW."local_oral/acao.php";
?>
<fieldset>
	<legend>Local onde será realizado</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idLocal_oral" name="idLocal_oral" value="<?php echo $Local_oral -> get_idLocal_oral() ?>" />
				
				<p>
				<label>Local:</label>
				<input type="text" name="local" id="local" value="<?php echo $Local_oral -> get_localLocal_oral()?>" class="required" />
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