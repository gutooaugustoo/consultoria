<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Telefone = new Telefone();

if( $idTelefone = $_REQUEST["idTelefone"] ){
	$Telefone->__construct($idTelefone);	
}else{
	$Telefone->set_pessoa_idTelefone($_REQUEST["pessoa_id"]);
	$Telefone->set_empresa_idTelefone($_REQUEST["empresa_id"]);
}
	
$nomeTable = "telefone";
$acao = CAM_VIEW."telefone/acao.php";
?>
<fieldset>
	<legend>Telefone</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idTelefone" name="idTelefone" value="<?php echo $Telefone -> get_idTelefone() ?>" />
				
				<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $Telefone -> get_pessoa_idTelefone() ?>" />
				<input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $Telefone -> get_empresa_idTelefone() ?>" />
						
				<p>
				<label>Descrição Telefone:</label>
				<?php $Descricaotelefone = new Descricaotelefone();
				Html::set_cssClass(array("required"));
				echo $Descricaotelefone -> selectDescricaotelefone_html('descricaoTelefone_id', $Telefone -> get_descricaoTelefone_idTelefone()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>DDD:</label>
				<input type="text" name="ddd" id="ddd" value="<?php echo $Telefone -> get_dddTelefone()?>" class="required numeric" maxlength="2" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Número:</label>
				<input type="text" name="numero" id="numero" value="<?php echo $Telefone -> get_numeroTelefone()?>" class="required fone" />
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