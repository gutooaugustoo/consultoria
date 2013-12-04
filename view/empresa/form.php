<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEmpresa = $_REQUEST["idEmpresa"];
$Empresa = new Empresa($idEmpresa);
$nomeTable = "empresa";
$acao = CAM_VIEW."empresa/acao.php";
?>
<fieldset>
	<legend>Empresa</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $Empresa -> get_idEmpresa() ?>" />
		
				<p>
				<label>Razao Social:</label>
				<input type="text" name="razaoSocial" id="razaoSocial" value="<?php echo $Empresa -> get_razaoSocialEmpresa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Nome Fantasia:</label>
				<input type="text" name="nomeFantasia" id="nomeFantasia" value="<?php echo $Empresa -> get_nomeFantasiaEmpresa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Cnpj:</label>
				<input type="text" name="cnpj" id="cnpj" value="<?php echo $Empresa -> get_cnpjEmpresa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Logo:</label>
				<input type="text" name="logo" id="logo" value="<?php echo $Empresa -> get_logoEmpresa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Ie:</label>
				<input type="text" name="ie" id="ie" value="<?php echo $Empresa -> get_ieEmpresa()?>" class="" />
				<span class="placeholder" ></span></p>
		
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Empresa -> get_inativoEmpresa())?> />
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