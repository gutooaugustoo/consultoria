<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPessoa = $_REQUEST["idPessoa"];
$Pessoa = new Pessoa($idPessoa);
$nomeTable = "pessoa";
$acao = CAM_VIEW."pessoa/acao.php";
?>
<fieldset>
	<legend>Pessoa</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $Pessoa -> get_idPessoa() ?>" />
		
				<p>
				<label>Pais:</label>
				<?php $Pais = new Pais();
				Html::set_cssClass(array("required"));
				echo $Pais -> selectPais_html('pais_id', $Pessoa -> get_pais_idPessoa()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Tipo Documento Unico:</label>
				<?php $Tipodocumentounico = new Tipodocumentounico();
				Html::set_cssClass(array("required"));
				echo $Tipodocumentounico -> selectTipodocumentounico_html('tipoDocumentoUnico_id', $Pessoa -> get_tipoDocumentoUnico_idPessoa()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Estado Civil:</label>
				<?php $Estadocivil = new Estadocivil();
				Html::set_cssClass(array("required"));
				echo $Estadocivil -> selectEstadocivil_html('estadoCivil_id', $Pessoa -> get_estadoCivil_idPessoa()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Pessoa -> get_nomePessoa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Rg:</label>
				<input type="text" name="rg" id="rg" value="<?php echo $Pessoa -> get_rgPessoa()?>" class="" />
				<span class="placeholder" ></span></p>
		
				<p>
				<label>Foto:</label>
				<input type="text" name="foto" id="foto" value="<?php echo $Pessoa -> get_fotoPessoa()?>" class="" />
				<span class="placeholder" ></span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Curriculum:</label>
				<input type="text" name="curriculum" id="curriculum" value="<?php echo $Pessoa -> get_curriculumPessoa()?>" class="" />
				<span class="placeholder" ></span></p>
		
				<p>
				<label>Cargo:</label>
				<input type="text" name="cargo" id="cargo" value="<?php echo $Pessoa -> get_cargoPessoa()?>" class="" />
				<span class="placeholder" ></span></p>
		
				<p>
				<label>Sexo:</label>
				<input type="text" name="sexo" id="sexo" value="<?php echo $Pessoa -> get_sexoPessoa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Senha:</label>
				<input type="text" name="senha" id="senha" value="<?php echo $Pessoa -> get_senhaPessoa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Documento:</label>
				<input type="text" name="documento" id="documento" value="<?php echo $Pessoa -> get_documentoPessoa()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Pessoa -> get_inativoPessoa())?> />
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