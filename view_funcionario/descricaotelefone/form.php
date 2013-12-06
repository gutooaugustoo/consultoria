<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idDescricaotelefone = $_REQUEST["idDescricaotelefone"];
$Descricaotelefone = new Descricaotelefone($idDescricaotelefone);
$nomeTable = "descricaotelefone";
$acao = CAM_VIEW."descricaotelefone/acao.php";
?>
<fieldset>
	<legend>Descrição telefone</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idDescricaotelefone" name="idDescricaotelefone" value="<?php echo $Descricaotelefone -> get_idDescricaotelefone() ?>" />
		   									
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Descricaotelefone -> get_nomeDescricaotelefone()?>" class="required" />
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