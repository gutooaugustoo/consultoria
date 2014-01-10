<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Oral = new Oral();
if( $idOral = $_REQUEST["idOral"] ){
  $Oral->__construct($idOral);
}else{
  $Oral->set_servico_idOral($_REQUEST["servico_id"]);  
  $Oral->set_etapa_idOral($_REQUEST["etapa_id"]);
}

$nomeTable = "oral";
$acao = CAM_VIEW."oral/acao.php";
?>
<fieldset>
	<legend>Oral</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <input type="hidden" id="idOral" name="idOral" value="<?php echo $Oral -> get_idOral() ?>" />
      <input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Oral -> get_servico_idOral() ?>" />
        
		  <div class="esquerda">		  					
			
				<p>
				<label>Etapa:</label>				
				<?php $Etapa = new Etapa($Oral->get_etapa_idOral());
        echo $Etapa->get_etapaEtapa();?>
        <input type="hidden" id="etapa_id" name="etapa_id" value="<?php echo $Oral->get_etapa_idOral()?>" />
        
				<?php /*$Etapa = new Etapa();
				Html::set_cssClass(array("required"));
				echo $Etapa -> selectEtapa_html('etapa_id', $Oral -> get_etapa_idOral()); */?>
				<!--<span class="placeholder" >Campo obrigatório</span>-->
				
				</p>
				
				<p><label for="video" >
				<input type="checkbox" name="video" id="video" value="1" class=""
				<?php echo Uteis::verificaChecked($Oral -> get_videoOral())?> />
				Disponibilizar <b>upload de vídeo</b> para o candidato</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="mostrarAnotacao" >
				<input type="checkbox" name="mostrarAnotacao" id="mostrarAnotacao" value="1" class=""
				<?php echo Uteis::verificaChecked($Oral -> get_mostrarAnotacaoOral())?> />
				Disponibilizar <b>VPG</b> para o avaliador</label>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p><label for="temAreaAtencao" >
				<input type="checkbox" name="temAreaAtencao" id="temAreaAtencao" value="1" class=""
				<?php echo Uteis::verificaChecked($Oral -> get_temAreaAtencaoOral())?> />
				O avaliador deverá preencher <b>área de atenção</b></label>
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