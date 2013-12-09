<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$nomeTable = "pergunta";
?>

<fieldset>
  <legend>Filtrar Pergunta</legend>
  
  <img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar filtros" id="imgGrupoFiltro_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoFiltro_<?php echo $nomeTable ?>', 'imgGrupoFiltro_<?php echo $nomeTable ?>');" />
	
  <div class="agrupa" id="divGrupoFiltro_<?php echo $nomeTable ?>">
    <form id="formFiltrar_<?php echo $nomeTable ?>"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="linha-inteira">
        <div class="esquerda">
        	 
					<p>
					<label>Pergunta:</label>
					<?php $Pergunta = new Pergunta();
					echo $Pergunta -> selectMultiplePergunta_html('pergunta_id'); ?>
					</p>
					
					<p>
					<label>ioma:</label>
					<?php $Idioma = new Idioma();
					echo $Idioma -> selectMultipleIdioma_html('idioma_id'); ?>
					</p>
					
					<p>
					<label>Categoria Pergunta:</label>
					<?php $Categoriapergunta = new Categoriapergunta();
					echo $Categoriapergunta -> selectMultipleCategoriapergunta_html('categoriaPergunta_id'); ?>
					</p>
					     
        </div>
        <div class="direita">
        	 
					<p>
					<label>Empresa:</label>
					<?php $Empresa = new Empresa();
					echo $Empresa -> selectMultipleEmpresa_html('empresa_id'); ?>
					</p>
					
					<p>
					<label>Nivel Pergunta:</label>
					<?php $Nivelpergunta = new Nivelpergunta();
					echo $Nivelpergunta -> selectMultipleNivelpergunta_html('nivelPergunta_id'); ?>
					</p>
					
					<p>
					<label>Status:</label>
					<?php echo Html::selectMultipleStatus_html(); ?>
					</p>
					     
        </div>
      </div>
      <div class="linha-inteira">
        <button id="btFiltro_<?php echo $nomeTable ?>" class="button blue" 
        onclick="filtro_postForm('imgGrupoFiltro_<?php echo $nomeTable ?>', 'formFiltrar_<?php echo $nomeTable ?>', '<?php echo CAM_VIEW."pergunta/lista.php"?>', '', '#divResFiltro_<?php echo $nomeTable ?>')" >
        Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<div id="divResFiltro_<?php echo $nomeTable ?>" > </div>

<script>ativarForm();</script>