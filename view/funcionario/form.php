<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idFuncionario = $_REQUEST["idFuncionario"];
$Pessoa = new Funcionario($idFuncionario);
$nomeTable = "funcionario";
$acao = CAM_VIEW."funcionario/acao.php";
?>
<fieldset>
	<legend>Funcionario</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  	
			<input type="hidden" id="idFuncionario" name="idFuncionario" value="<?php echo $Pessoa -> get_idFuncionario() ?>" />
		  
		  <?php include "../pessoa/form.php";?>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>ativarForm();</script> 