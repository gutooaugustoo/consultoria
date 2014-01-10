<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Oral_dicas = new Oral_dicas();
if( $idOral_dicas = $_REQUEST["idOral_dicas"] ){
  $Oral_dicas->__construct($idOral_dicas);
}else{
  $Oral_dicas->set_oral_idOral_dicas($_REQUEST["oral_id"]);
}

$nomeTable = "oral_dicas";
$acao = CAM_VIEW."oral_dicas/acao.php";
?>
<fieldset>
	<legend>Oral Dicas</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idOral_dicas" name="idOral_dicas" value="<?php echo $Oral_dicas -> get_idOral_dicas() ?>" />
				<input type="hidden" id="oral_id" name="oral_id" value="<?php echo $Oral_dicas -> get_oral_idOral_dicas() ?>" />
						
				<p>
				<label>Dicas:</label>
				<?php $Dicasentrevista = new Dicasentrevista();
				Html::set_cssClass(array("required"));
				echo $Dicasentrevista -> selectDicasentrevista_html('dicasEntrevista_id', $Oral_dicas -> get_dicasEntrevista_idOral_dicas()); ?>
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