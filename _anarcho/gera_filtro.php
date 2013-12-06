<?php
$carrega = "";
$cont = 0;

foreach ($campos as $campo) {
	//echo"<pre>";print_r($campo);echo"</pre>";
	if ($campo['relac'] == 'fk' || $campo['nome'] == 'inativo') {

		if ($campo['nome'] == 'inativo') {
			$carrega = "
					<p>
					<label>Status:</label>
					<?php echo Html::selectMultipleStatus_html(); ?>
					</p>
					";

		} else {
			$carrega = "
					<p>
					<label>" . $campo['nomeAmigavel'] . ":</label>
					<?php \$" . $campo['relacTb'] . " = new " . $campo['relacTb'] . "();" . "
					echo \$" . $campo['relacTb'] . " -> selectMultiple" . $campo['relacTb'] . "_html('" . $campo['nome'] . "'); ?>
					</p>
					";
		}

		if ($cont % 2 == 0) {
			//echo "esquerda - ";
			$carrega_esquerda .= $carrega;
		} else {
			//echo "direita - ";
			$carrega_direita .= $carrega;
		}
		
		$cont++;
		$carrega = "";
	}
}

$conteudoArquivo = "";
$conteudoArquivo = "<?php
require_once (\$_SERVER['DOCUMENT_ROOT'] . \"/consultoria/config/verificar.php\");

\$nomeTable = \"" . $table . "\";
?>

<fieldset>
  <legend>Filtrar " . $tabelaNome . "</legend>
  
  <img src=\"<?php echo CAM_IMG.\"menos.png\"?>\" title=\"Abrir/Fechar filtros\" id=\"imgGrupoFiltro_<?php echo \$nomeTable ?>\" 
	onclick=\"abrirFormulario('divGrupoFiltro_<?php echo \$nomeTable ?>', 'imgGrupoFiltro_<?php echo \$nomeTable ?>');\" />
	
  <div class=\"agrupa\" id=\"divGrupoFiltro_<?php echo \$nomeTable ?>\">
    <form id=\"formFiltrar_<?php echo \$nomeTable ?>\"  class=\"validate\" method=\"post\" action=\"\" onsubmit=\"return false\" >
      <div class=\"linha-inteira\">
        <div class=\"esquerda\">
        	 " . $carrega_esquerda . "     
        </div>
        <div class=\"direita\">
        	 " . $carrega_direita . "     
        </div>
      </div>
      <div class=\"linha-inteira\">
        <button id=\"btFiltro_<?php echo \$nomeTable ?>\" class=\"button blue\" 
        onclick=\"filtro_postForm('imgGrupoFiltro_<?php echo \$nomeTable ?>', 'formFiltrar_<?php echo \$nomeTable ?>', '<?php echo CAM_VIEW.\"" . $table . "/lista.php\"?>', '', '#divResFiltro_<?php echo \$nomeTable ?>')\" >
        Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<div id=\"divResFiltro_<?php echo \$nomeTable ?>\" > </div>

<script>ativarForm();</script>";

gravarArquivo("view_funcionario/".$table, $table, "filtro", $conteudoArquivo);
