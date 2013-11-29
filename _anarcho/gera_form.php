<?php
$tableUp = ucfirst($table);
$tabelaNome = separaString($table);

$form = "";
foreach ($campos as $campo) {

	if ($campo['relac'] == 'pk') {

		$form .= "
					<input type=\"hidden\" id=\"" . $campo['nome'] . "\" name=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $campo['nome'] . " ?>\" />
		";

	} elseif ($campo['relac'] == 'fk') {

		$form .= "
					<p>
					<label>" . $campo['nome2'] . ":</label>
					<?php 
					\$Fk = new \$Fk();" . ($campo['accNulo'] == 1 ? "" : "
					Html::set_cssClass(array(\"required\"));") . "
					echo \$Fk->select_html('" . $campo['nome'] . "', \$" . $tableUp . "->get_" . $campo['nome'] . "());
					?>";

	} elseif ($campo['tipo'] == 'int' || $campo['tipo'] == 'double') {

		$form .= "
					<p>
					<label>" . $campo['nome2'] . ":</label>
					<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . "->get_" . $campo['nome'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required ") . "numeric\" />";

	} elseif ($campo['tipo'] == 'tinyint') {

		$form .= "
					<p><label for=\"" . $campo['nome'] . "\" >
					<input type=\"checkbox\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"1\" class=\"\"
					<?php echo Uteis::verificaChecked(\$" . $tableUp . "->get_" . $campo['nome'] . "())?> />
					" . $campo['nome2'] . ":</label>";

	} elseif ($campo['tipo'] == 'date') {

		$form .= "
					<p>
					<label>" . $campo['nome2'] . ":</label>
					<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . "->get_" . $campo['nome'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required ") . "data\" />";

	} elseif ($campo['tipo'] == 'datetime' || $campo['tipo'] == 'varchar') {

		$form .= "
					<p>
					<label>" . $campo['nome2'] . ":</label>
					<input type=\"text\" name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" value=\"<?php echo \$" . $tableUp . "->get_" . $campo['nome'] . "()?>\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required") . "\" />";

	} elseif ($campo['tipo'] == 'text') {

		$form .= "
					<p>
					<label>" . $campo['nome2'] . ":</label>
					<textarea name=\"" . $campo['nome'] . "\" id=\"" . $campo['nome'] . "\" cols=\"60\" rows=\"4\" class=\"" . ($campo['accNulo'] == 1 ? "" : "required") . "\" ><?php echo \$" . $tableUp . "->get_" . $campo['nome'] . "()?></textarea>";

	}

	if ($campo['relac'] != 'pk') {
		$form .= "
					<span class=\"placeholder\" >" . ($campo['accNulo'] == 1 ? "" : "Campo obrigatório") . "</span></p>
		";
	}

}
$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$id = \$_REQUEST[\"id\"];

\$" . $tableUp . " = new " . $tableUp . "(\$id);

\$nomeTable = \"" . ($table) . "\";
\$legendForm = \"" . ($tabelaNome) . "\";
\$acao = CAM_VIEW.\"" . ($table) . "/acao.php\";
?>

<div id=\"cadastro_<?php echo \$nomeTable ?>\" class=\"\">
	<div id=\"fechar_nivel\" class=\"fechar\" onclick=\"fecharNivel(nivel);\" title=\"Fechar\"></div>
	<div id=\"abas\">
		<div id=\"aba_<?php echo \$nomeTable ?>\" divExibir=\"div_<?php echo \$nomeTable ?>\" class=\"aba_interna ativa\"><?php echo \$legendForm ?></div>
	</div>
	<div id=\"modulos_<?php echo \$nomeTable ?>\" class=\"conteudo_nivel\">
		<div id=\"div_<?php echo \$nomeTable ?>\" class=\"div_aba_interna\">
			<fieldset>
				<legend><?php echo \$legendForm ?></legend>
				<form id=\"form_<?php echo \$nomeTable ?>\" class=\"validate\" method=\"post\" onsubmit=\"return false\" >
          <div class=\"esquerda\">
          
						<input type=\"hidden\" id=\"acao\" name=\"acao\" value=\"cadastrar\" />					
						" . $form . "   					
						<p><button class=\"button blue\" 
						onclick=\"postForm('form_<?php echo \$nomeTable ?>', '<?php echo \$acao?>')\" >Enviar</button>
						</p>
					</div>
				</form>
			</fieldset>			
		</div>
	</div>
</div>
<script>ativarForm();</script> 
";

$pathname = "../view/" . $table;
if (!file_exists($pathname))
	mkdir($pathname, 0700);
$nomeArquivo = $pathname . "/form.php";

if( !file_exists($nomeArquivo) || $sobrescrever ) {


	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['form'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
