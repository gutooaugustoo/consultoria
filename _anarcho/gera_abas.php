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
?>

<div id=\"cadastro_" . $table . "\" class=\"\">
	<div id=\"fechar_nivel\" class=\"fechar\" onclick=\"fecharNivel(nivel);\" title=\"Fechar\"></div>
	<div id=\"abas\">
		<div id=\"aba_" . $table . "\" divExibir=\"div_" . $table . "\" class=\"aba_interna ativa\"
		onclick=\"carregarModulo('<?php echo CAM_VIEW.\"".$table."/form.php?id" . $tableUp."=\".\$id" . $tableUp."?>' , '#div_" . $table . "')\" >" . $tabelaNome . "</div>
	</div>
	<div id=\"modulos_<?php echo \$nomeTable ?>\" class=\"conteudo_nivel\">
		<div id=\"div_" . $table . "\" class=\"div_aba_interna\">			
			<?php include \"form.php\"; ?>						
		</div>
	</div>
</div>
";

gravarArquivo("view/".$table, $table, "abas", $conteudoArquivo);
