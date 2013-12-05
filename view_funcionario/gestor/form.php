<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Pessoa = new Gestor();

if( $idGestor = $_REQUEST["idGestor"] ){
	$Pessoa->__construct($idGestor);	
}else{	
	$Pessoa->set_empresa_idGestor($_REQUEST["empresa_id"]);
}

$nomeTable = "gestor";
$acao = CAM_VIEW."gestor/acao.php";
?>
<fieldset>
	<legend>Gestor</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  		  
			<input type="hidden" id="idGestor" name="idGestor" value="<?php echo $Pessoa -> get_idGestor() ?>" />
			<input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $Pessoa -> get_empresa_idGestor() ?>" />
		  
			<?php
			include "../pessoa/form.php";
			?>
						
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>ativarForm();</script> 