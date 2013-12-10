<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$nomeTable = "servico";
?>

<fieldset>
  <legend>Filtrar Servico</legend>
  
  <img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar filtros" id="imgGrupoFiltro_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoFiltro_<?php echo $nomeTable ?>', 'imgGrupoFiltro_<?php echo $nomeTable ?>');" />
	
  <div class="agrupa" id="divGrupoFiltro_<?php echo $nomeTable ?>">
    <form id="formFiltrar_<?php echo $nomeTable ?>"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="linha-inteira">
        <div class="esquerda">
        	 
					<p>
					<label>Empresa:</label>
					<?php $Empresa = new Empresa();
					echo $Empresa -> selectMultipleEmpresa_html('empresa_id'); ?>
					</p>
					
					<p>
					<label>Servico:</label>
					<?php $Servico = new Servico();
					echo $Servico -> selectMultipleServico_html('servico_id'); ?>
					</p>
					     
        </div>
        <div class="direita">
        	 
					<p>
					<label>ioma:</label>
					<?php $Idioma = new Idioma();
					echo $Idioma -> selectMultipleIdioma_html('idioma_id'); ?>
					</p>
					     
        </div>
      </div>
      <div class="linha-inteira">
        <button id="btFiltro_<?php echo $nomeTable ?>" class="button blue" 
        onclick="filtro_postForm('imgGrupoFiltro_<?php echo $nomeTable ?>', 'formFiltrar_<?php echo $nomeTable ?>', '<?php echo CAM_VIEW."servico/lista.php"?>', '', '#divResFiltro_<?php echo $nomeTable ?>')" >
        Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<div id="divResFiltro_<?php echo $nomeTable ?>" > </div>

<script>ativarForm();</script>