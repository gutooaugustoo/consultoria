<?php
$form_direita = "";
$form_esquerda = "";
foreach ($campos as $key => $campo) {

	if ($campo['relac'] == 'pk') {

		$form = "
				<input type=\"hidden\" id=\"" . $campo['nomeComTabela'] . "\" name=\"" . $campo['nomeComTabela'] . "\" value=\"<?php echo \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "() ?>\" />
		";

	} elseif ($campo['relac'] == 'fk') {

		$form = "
				<p>
				<label>" . $campo['nomeAmigavel'] . ":</label>
				<?php \$" . $campo['relacTb'] . " = new " . $campo['relacTb'] . "();" . ($campo['accNulo'] == 1 ? "" : "
				Html::set_cssClass(array(\"required\"));") . "
				echo \$" . $campo['relacTb'] . " -> select" . $campo['relacTb'] . "_html('" . $campo['nome'] . "', \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "()); ?>";

	} elseif ($campo['tipo'] == 'int' || $campo['tipo'] == 'double') {

		$form = "
				<p>
				<label>" . $campo['nomeAmigavel'] . ":</label>
				<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required ") . "numeric\" />";

	} elseif ($campo['tipo'] == 'tinyint') {

		$form = "
				<p><label for=\"" . $campo['nome'] . "\" >
				<input type=\"checkbox\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"1\" class=\"\"
				<?php echo Uteis::verificaChecked(\$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "())?> />
				" . $campo['nomeAmigavel'] . "</label>";

	} elseif ($campo['tipo'] == 'date') {

		$form = "
				<p>
				<label>" . $campo['nomeAmigavel'] . ":</label>
				<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required ") . "data\" />";

	} elseif ($campo['tipo'] == 'datetime' || $campo['tipo'] == 'varchar' || $campo['tipo'] == 'char') {

		$form = "
				<p>
				<label>" . $campo['nomeAmigavel'] . ":</label>
				<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required") . "\" />";

	} elseif ($campo['tipo'] == 'text') {

		$form = "
				<p>
				<label>" . $campo['nomeAmigavel'] . ":</label>
				<textarea name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" cols=\"60\" rows=\"4\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required") . "\" ><?php echo \$" . $tableUp . " -> get_" . $campo['nomeComTabela'] . "()?></textarea>";

	}

	if ( $campo['relac'] != 'pk' && $campo['tipo'] != 'tinyint') {
		$form .= "
				<span class=\"placeholder\" >" . ($campo['accNulo'] == 1 ? "" : "Campo obrigatório") . "</span></p>
		";
	}
	
	if( $key < count($campos)/2 ){
		$form_esquerda .= $form;
	}else{
		$form_direita .= $form;
	}
	
	$form = "";
	
}

////////////////////////////////////// ARQUIVO FORM

$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/verificar.php\");

\$" . $tableUp . " = new " . $tableUp . "();
if( \$id" . $tableUp . " = \$_REQUEST[\"id" . $tableUp . "\"] ){
  \$" . $tableUp . "->__construct(\$id" . $tableUp . ");
}else{
  //\$" . $tableUp . "->set_(\$_REQUEST[\"\"]);
}

\$nomeTable = \"" . ($table) . "\";
\$acao = CAM_VIEW.\"" . ($table) . "/acao.php\";
?>
<fieldset>
	<legend>" . $tabelaNome . "</legend>
	
	<img src=\"<?php echo CAM_IMG.\"menos.png\"?>\" title=\"Abrir/Fechar formuário\" id=\"imgGrupoForm_<?php echo \$nomeTable ?>\" 
	onclick=\"abrirFormulario('divGrupoForm_<?php echo \$nomeTable ?>', 'imgGrupoForm_<?php echo \$nomeTable ?>');\" />

	<div class=\"agrupa\" id=\"divGrupoForm_<?php echo \$nomeTable ?>\">
  	
		<form id=\"formCad_<?php echo \$nomeTable ?>\" class=\"validate\" method=\"post\" onsubmit=\"return false\" >
		  
		  <input type=\"hidden\" id=\"acao\" name=\"acao\" value=\"cadastrar\" />
		  
		  <div class=\"esquerda\">		  					
				" . $form_esquerda . "   									
			</div>
			
			<div class=\"direita\">
				" . $form_direita . "
			</div>
			
			<div class=\"linha-inteira\">
				<p><button class=\"button blue\" 
				onclick=\"postForm('formCad_<?php echo \$nomeTable ?>', '<?php echo \$acao?>')\" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>ativarForm();</script> ";

gravarArquivo("view_candidato/".$table, $table, "form", $conteudoArquivo);
