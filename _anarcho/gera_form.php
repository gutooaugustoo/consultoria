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
				" . $campo['nomeAmigavel'] . ":</label>";

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

	if ($campo['relac'] != 'pk') {
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
$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$id" . $tableUp . " = \$_REQUEST[\"id" . $tableUp . "\"];
\$nomeTable = \"" . $table . "\";
?>

<div id=\"cadastro_<?php echo \$nomeTable ?>\" class=\"\">
	<div id=\"fechar_nivel\" class=\"fechar\" onclick=\"fecharNivel(nivel);\" title=\"Fechar\"></div>
	<div id=\"abas\">
		<div id=\"aba_<?php echo \$nomeTable ?>\" divExibir=\"div_<?php echo \$nomeTable ?>\" class=\"aba_interna ativa\"
		onclick=\"carregarModulo('<?php echo CAM_VIEW.\"".$table."/_form.php?id" . $tableUp."=\".\$id" . $tableUp."?>' , '#div_<?php echo \$nomeTable ?>')\" >" . $tabelaNome . "</div>
	</div>
	<div id=\"modulos_<?php echo \$nomeTable ?>\" class=\"conteudo_nivel\">
		<div id=\"div_<?php echo \$nomeTable ?>\" class=\"div_aba_interna\">			
			<?php include \"_form.php\"; ?>						
		</div>
	</div>
</div>
<script>ativarForm();</script> 
";

////////////////////////////////////// ARQUIVO FORM

$conteudoArquivo_form = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$id" . $tableUp . " = \$_REQUEST[\"id" . $tableUp . "\"];
\$" . $tableUp . " = new " . $tableUp . "(\$id" . $tableUp . ");
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
</fieldset>";

$pathname = "../view/" . $table;
if (!file_exists($pathname))
	mkdir($pathname, 0700);
$nomeArquivo = $pathname . "/form.php";

if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['abas'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}

$nomeArquivo = $pathname . "/_form.php";
if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo_form);
	fclose($arquivo);
	$gerada['form'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
