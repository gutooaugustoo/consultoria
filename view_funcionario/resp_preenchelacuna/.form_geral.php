<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$pergunta_id = $_REQUEST["pergunta_id"];
$Pergunta = new Pergunta($pergunta_id);

$nomeTable = "resp_preenchelacuna";
$acao = CAM_VIEW."resp_preenchelacuna/acao.php";
?>
<fieldset>
	<legend>Montar lacunas</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="gerarLacuna" />
		  
		  <div class="linha-inteira">		  					
				
				<input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $Pergunta -> get_idPergunta() ?>" />
				
				<!--<p>
				<label>Enunciado:</label>
				<strong><?php echo $Pergunta -> get_tituloPergunta()?></strong></p>-->		
						
				<p><label>Selecione o texto e clique em "Gerar lacuna":</label>	
					<!--<div id="div_enunciado"><?php echo $Pergunta -> get_enunciadoPergunta()?></div>-->
					<textarea name="enunciado_base" id="enunciado_base" class="" ><?php echo $Pergunta -> get_enunciadoPergunta()?></textarea>
					<textarea name="enunciado" id="enunciado" class="required"></textarea>
					<span class="placeholder" >Campo obrigatório</span>															
				</p>
						
			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm_editor('enunciado', 'formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Gerar lacuna</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>
ativarForm();
viraEditor_lacuna('enunciado');
</script> 