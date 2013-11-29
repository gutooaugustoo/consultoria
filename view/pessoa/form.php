<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPessoa = $_REQUEST["idPessoa"];

$Pessoa = new Pessoa($idPessoa);

$nomeTable = "pessoa";
$legendForm = "Pessoa";
$acao = CAM_VIEW."pessoa/acao.php";
?>

<div id="cadastro_<?php echo $nomeTable ?>" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_<?php echo $nomeTable ?>" divExibir="div_<?php echo $nomeTable ?>" class="aba_interna ativa"><?php echo $legendForm ?></div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_<?php echo $nomeTable ?>" class="div_aba_interna">
			<fieldset>
				<legend><?php echo $legendForm ?></legend>
				<form id="form_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
          <div class="esquerda">
          
						<input type="hidden" id="acao" name="acao" value="cadastrar" />					
						
						<input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $Pessoa -> get_idPessoa() ?>" />
		
						<p>
						<label>Pais:</label>
						<?php /*$Pais = new Pais();
						Html::set_cssClass(array("required"));
						echo $Pais -> selectPais_html('pais_id', $Pessoa -> get_pais_idPessoa()); */ ?>
						<span class="placeholder" >Campo obrigatório</span></p>
		
						<p>
						<label>Tipo Documento Unico:</label>
						<?php /*$Tipodocumentounico = new Tipodocumentounico();
						Html::set_cssClass(array("required"));
						echo $Tipodocumentounico -> selectTipodocumentounico_html('tipoDocumentoUnico_id', $Pessoa -> get_tipoDocumentoUnico_idPessoa()); */ ?>
						<span class="placeholder" >Campo obrigatório</span></p>
		
						<p>
						<label>Estado Civil:</label>
						<?php /*$Estadocivil = new Estadocivil();
						Html::set_cssClass(array("required"));
						echo $Estadocivil -> selectEstadocivil_html('estadoCivil_id', $Pessoa -> get_estadoCivil_idPessoa()); */ ?>
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
		   					
						<p><button class="button blue" 
						onclick="postForm('form_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
						</p>
						
					</div>
				</form>
			</fieldset>			
		</div>
	</div>
</div>
<script>ativarForm();</script> 
