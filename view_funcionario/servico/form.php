<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idServico = $_REQUEST["idServico"];
$Servico = new Servico($idServico);
$nomeTable = "servico";
$acao = CAM_VIEW."servico/acao.php";
//Uteis::pr($Servico);
?>
<fieldset>
	<legend>Serviço</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idServico" name="idServico" value="<?php echo $Servico -> get_idServico() ?>" />
				
				<p>
				<label>Descrição:</label>
				<input type="text" name="descricao" id="descricao" value="<?php echo $Servico -> get_descricaoServico()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Data Inicio:</label>
				<input type="text" name="dataInicio" id="dataInicio" value="<?php echo $Servico -> get_dataInicioServico()?>" class="required data" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Data Validade:</label>
				<input type="text" name="dataValidade" id="dataValidade" value="<?php echo $Servico -> get_dataValidadeServico()?>" class="required data" />
				<span class="placeholder" >Campo obrigatório</span></p>
						
				<p>
				<label>Empresa:</label>
				<?php $Empresa = new Empresa();
				Html::set_cssClass(array("required"));
				echo $Empresa -> selectEmpresa_html('empresa_id', $Servico -> get_empresa_idServico()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Idioma:</label>
				<?php $Idioma = new Idioma();
				Html::set_cssClass(array("required"));
				echo $Idioma -> selectIdioma_html('idioma_id', $Servico -> get_idioma_idServico()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Pertence a um grupo de serviços:</label>
				<?php //$Servico = new Servico();
				echo $Servico -> selectServico_html('servico_id', $Servico -> get_servico_idServico(), " WHERE S.id NOT IN(".Uteis::escapeRequest($idServico).")" ); ?>
				<span class="placeholder" ></span></p>
		   									
			</div>
			
			<div class="direita">				
				<p><label for="temOral" >
				<input type="checkbox" name="temOral" id="temOral" value="1" class=""
				<?php echo Uteis::verificaChecked($Servico -> get_temOralServico())?> />
				Tem Oral:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="temEscrito" >
				<input type="checkbox" name="temEscrito" id="temEscrito" value="1" class=""
				<?php echo Uteis::verificaChecked($Servico -> get_temEscritoServico())?> />
				Tem Escrito:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="temRedacao" >
				<input type="checkbox" name="temRedacao" id="temRedacao" value="1" class=""
				<?php echo Uteis::verificaChecked($Servico -> get_temRedacaoServico())?> />
				Tem Redacao:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="temResultadoFinal" >
				<input type="checkbox" name="temResultadoFinal" id="temResultadoFinal" value="1" class=""
				<?php echo Uteis::verificaChecked($Servico -> get_temResultadoFinalServico())?> />
				Tem Resultado Final:</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="60" rows="4" class="" ><?php echo $Servico -> get_obsServico()?></textarea>
				<span class="placeholder" ></span></p>
		
				<!--<p>
				<label>Hash:</label>
				<input type="text" name="hash" id="hash" value="<?php echo $Servico -> get_hashServico()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>-->
		
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