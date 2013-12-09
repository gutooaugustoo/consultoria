<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idAreaatencao = $_REQUEST["idAreaatencao"];
$Areaatencao = new Areaatencao($idAreaatencao);
$nomeTable = "areaatencao";
$acao = CAM_VIEW."areaatencao/acao.php";
?>
<fieldset>
	<legend>Área atenção</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idAreaatencao" name="idAreaatencao" value="<?php echo $Areaatencao -> get_idAreaatencao() ?>" />
		
				<p>
				<label>Idioma:</label>
				<?php $Idioma = new Idioma();
				Html::set_cssClass(array("required"));
				echo $Idioma -> selectIdioma_html('idioma_id', $Areaatencao -> get_idioma_idAreaatencao()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   																
				<p>
				<label>Descrição:</label>
				<input type="text" name="descricao" id="descricao" value="<?php echo $Areaatencao -> get_descricaoAreaatencao()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="inativo" >
				<input type="checkbox" name="inativo" id="inativo" value="1" class=""
				<?php echo Uteis::verificaChecked($Areaatencao -> get_inativoAreaatencao())?> />
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