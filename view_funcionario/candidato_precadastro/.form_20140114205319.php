<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_precadastro = new Candidato_precadastro();
if( $idCandidato_precadastro = $_REQUEST["idCandidato_precadastro"] ){
  $Candidato_precadastro->__construct($idCandidato_precadastro);
}else{
  //$Candidato_precadastro->set_($_REQUEST[""]);
}

$nomeTable = "candidato_precadastro";
$acao = CAM_VIEW."candidato_precadastro/acao.php";
?>
<fieldset>
	<legend>Candato Precadastro</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="emailCandidato_precadastro" name="emailCandidato_precadastro" value="<?php echo $Candidato_precadastro -> get_emailCandidato_precadastro() ?>" />
		
				<p>
				<label>Servico:</label>
				<?php $Servico = new Servico();
				Html::set_cssClass(array("required"));
				echo $Servico -> selectServico_html('servico_id', $Candidato_precadastro -> get_servico_idCandidato_precadastro()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" value="<?php echo $Candidato_precadastro -> get_nomeCandidato_precadastro()?>" class="required" />
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