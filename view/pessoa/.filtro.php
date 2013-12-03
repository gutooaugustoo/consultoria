<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/admin.php");

$nomeTable = "pessoa";
?>

<fieldset>
  <legend>Filtrar Pessoa</legend>
  
  <img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar filtros" id="imgGrupoFiltro_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoFiltro_<?php echo $nomeTable ?>', 'imgGrupoFiltro_<?php echo $nomeTable ?>');" />
	
  <div class="agrupa" id="divGrupoFiltro_<?php echo $nomeTable ?>">
    <form id="formFiltrar_<?php echo $nomeTable ?>"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="linha-inteira">
        <div class="esquerda">
        	 
					<p>
					<label>Pais:</label>
					<?php $Pais = new Pais();
					echo $Pais -> selectMultiplePais_html('pais_id'); ?>
					</p>
					
					<p>
					<label>Estado Civil:</label>
					<?php $Estadocivil = new Estadocivil();
					echo $Estadocivil -> selectMultipleEstadocivil_html('estadoCivil_id'); ?>
					</p>
					     
        </div>
        <div class="direita">
        	 
					<p>
					<label>Tipo Documento Unico:</label>
					<?php $Tipodocumentounico = new Tipodocumentounico();
					echo $Tipodocumentounico -> selectMultipleTipodocumentounico_html('tipoDocumentoUnico_id'); ?>
					</p>
					
					<p>
					<label>Status:</label>
					<?php echo Html::selectMultipleStatus_html(); ?>
					</p>
					     
        </div>
      </div>
      <div class="linha-inteira">
        <button id="btFiltro_<?php echo $nomeTable ?>" class="button blue" 
        onclick="filtro_postForm('imgGrupoFiltro_<?php echo $nomeTable ?>', 'formFiltrar_<?php echo $nomeTable ?>', '<?php echo CAM_VIEW."pessoa/lista.php"?>', '', '#divResFiltro_<?php echo $nomeTable ?>')" >
        Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<div id="divResFiltro_<?php echo $nomeTable ?>" > </div>

<script>ativarForm();</script>