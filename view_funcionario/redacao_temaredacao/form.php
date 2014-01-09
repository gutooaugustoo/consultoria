<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Redacao_temaredacao = new Redacao_temaredacao();
if( $idRedacao_temaredacao = $_REQUEST["idRedacao_temaredacao"] ){
  $Redacao_temaredacao->__construct($idRedacao_temaredacao);
}else{
  $Redacao_temaredacao->set_redacao_idRedacao_temaredacao($_REQUEST["redacao_id"]);
}

$nomeTable = "redacao_temaredacao";
$acao = CAM_VIEW."redacao_temaredacao/acao.php";
?>
<fieldset>
	<legend>Tema</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idRedacao_temaredacao" name="idRedacao_temaredacao" value="<?php echo $Redacao_temaredacao -> get_idRedacao_temaredacao() ?>" />
				<input type="hidden" id="redacao_id" name="redacao_id" value="<?php echo $Redacao_temaredacao -> get_redacao_idRedacao_temaredacao() ?>" />
		
				<p>
				<label>Tema:</label>
				<?php $Temaredacao = new Temaredacao();
				Html::set_cssClass(array("required"));
				echo $Temaredacao -> selectTemaredacao_html('temaRedacao_id', $Redacao_temaredacao -> get_temaRedacao_idRedacao_temaredacao()); ?>
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