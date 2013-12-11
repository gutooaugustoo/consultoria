<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Escrito = new Escrito();
if( $idEscrito = $_REQUEST["idEscrito"] ){
  $Escrito->__construct($idEscrito);
}else{
  $Escrito->set_servico_idEscrito($_REQUEST["servico_id"]);
}

$nomeTable = "escrito";
$acao = CAM_VIEW."escrito/acao.php";
?>
<fieldset>
	<legend>Escrito</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEscrito" name="idEscrito" value="<?php echo $Escrito -> get_idEscrito() ?>" />
				<input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Escrito -> get_servico_idEscrito() ?>" />
		
				<p>
				<label>Etapa:</label>
				<?php $Etapa = new Etapa();
				Html::set_cssClass(array("required"));
				echo $Etapa -> selectEtapa_html('etapa_id', $Escrito -> get_etapa_idEscrito()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Tipo Escrito:</label>
				<?php $Tipoescrito = new Tipoescrito();
				Html::set_cssClass(array("required"));
				echo $Tipoescrito -> selectTipoescrito_html('tipoEscrito_id', $Escrito -> get_tipoEscrito_idEscrito()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		  
				<p><label for="randomico" >
				<input type="checkbox" name="randomico" id="randomico" value="1" class=""
				<?php echo Uteis::verificaChecked($Escrito -> get_randomicoEscrito())?> />
				Randomico</label>
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