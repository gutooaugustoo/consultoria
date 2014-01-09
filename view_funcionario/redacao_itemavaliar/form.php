<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Redacao_itemavaliar = new Redacao_itemavaliar();
if( $idRedacao_itemavaliar = $_REQUEST["idRedacao_itemavaliar"] ){
  $Redacao_itemavaliar->__construct($idRedacao_itemavaliar);
}else{
  $Redacao_itemavaliar->set_redacao_idRedacao_itemavaliar($_REQUEST["redacao_id"]);
}

$nomeTable = "redacao_itemavaliar";
$acao = CAM_VIEW."redacao_itemavaliar/acao.php";
?>
<fieldset>
	<legend>Item avaliar</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idRedacao_itemavaliar" name="idRedacao_itemavaliar" value="<?php echo $Redacao_itemavaliar -> get_idRedacao_itemavaliar() ?>" />
		    <input type="hidden" id="redacao_id" name="redacao_id" value="<?php echo $Redacao_itemavaliar -> get_redacao_idRedacao_itemavaliar() ?>" />
		    
				<p>
				<label>Item avaliar:</label>
				<?php $Itemavaliarredacao = new Itemavaliarredacao();
				Html::set_cssClass(array("required"));
				echo $Itemavaliarredacao -> selectItemavaliarredacao_html('itemAvaliarRedacao_id', $Redacao_itemavaliar -> get_itemAvaliarRedacao_idRedacao_itemavaliar()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				
				<p><label for="obsTem" >
				<input type="checkbox" name="obsTem" id="obsTem" value="1" class=""
				<?php echo Uteis::verificaChecked($Redacao_itemavaliar -> get_obsTemRedacao_itemavaliar())?> />
				Terá observação</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="obsObrigatorio" >
				<input type="checkbox" name="obsObrigatorio" id="obsObrigatorio" value="1" class=""
				<?php echo Uteis::verificaChecked($Redacao_itemavaliar -> get_obsObrigatorioRedacao_itemavaliar())?> />
				Observação será obrigatório</label>
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