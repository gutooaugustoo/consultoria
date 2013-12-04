<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEndereco = $_REQUEST["idEndereco"];
$Endereco = new Endereco($idEndereco);
$nomeTable = "endereco";
$acao = CAM_VIEW."endereco/acao.php";
?>
<fieldset>
	<legend>Endereço</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEndereco" name="idEndereco" value="<?php echo $Endereco -> get_idEndereco() ?>" />
				
				<p>
				<label>Pais:</label>
				<?php $Pais = new Pais();
				Html::set_cssClass(array("required"));
				echo $Pais -> selectPais_html('pais_id', $Endereco -> get_pais_idEndereco()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Cade:</label>
				<?php $Cidade = new Cidade();
				echo $Cidade -> selectCidade_html('cidade_id', $Endereco -> get_cidade_idEndereco()); ?>
				<span class="placeholder" ></span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Bairro:</label>
				<input type="text" name="bairro" id="bairro" value="<?php echo $Endereco -> get_bairroEndereco()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Numero:</label>
				<input type="text" name="numero" id="numero" value="<?php echo $Endereco -> get_numeroEndereco()?>" class="required numeric" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Cep:</label>
				<input type="text" name="cep" id="cep" value="<?php echo $Endereco -> get_cepEndereco()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Complemento:</label>
				<input type="text" name="complemento" id="complemento" value="<?php echo $Endereco -> get_complementoEndereco()?>" class="" />
				<span class="placeholder" ></span></p>
		
				<p>
				<label>Cade Estrangeira:</label>
				<input type="text" name="cidadeEstrangeira" id="cidadeEstrangeira" value="<?php echo $Endereco -> get_cidadeEstrangeiraEndereco()?>" class="" />
				<span class="placeholder" ></span></p>
		
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