<?php
$carrega = "";
foreach ($campos as $campo) {
	$carrega .= "\"" . $tableAs . "." . $campo['nome'] . "\", ";
}

$carrega2 = "";
foreach ($campos as $campo) {
	if ($campo['relac'] != 'pk')
		$carrega2 .= "\"" . $campo['nomeAmigavel'] . "\", ";
}

$carrega3 = "";
if (isset($_POST["filtro"])) {
	foreach ($campos as $campo) {
		if ($campo['relac'] == 'fk') {
			$carrega3 .= "
\$" . $campo['nome'] . " = implode(\",\", \$_POST['" . $campo['nome'] . "']);
if( \$" . $campo['nome'] . " ) \$where .= \" AND " . $tableAs . "." . $campo['nome'] . " IN(\".Uteis::escapeRequest(\$" . $campo['nome'] . ").\")\";
";
		}elseif( $campo['nome'] == 'inativo' ){
			$carrega3 .= "
\$status = implode(\",\", \$_POST['status']);
if( \$status != \"\" ) \$where .= \" AND " . $tableAs . ".inativo IN(\".Uteis::escapeRequest(\$status).\")\";";
		}
		
	}
}

$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$" . $tableUp . " = new " . $tableUp . "();

\$idTabela = \"tb_" . $table . "\";
\$campos = array(" . $carrega . ");
\$caminho = CAM_VIEW.\"" . $table . "/\";
\$atualizar = CAM_VIEW.\"" . $table . "/lista.php\";
\$ondeAtualizar = \"tr\";	

if( \$_REQUEST[\"tr\"] == \"1\" ){
	//ATUALIZAR APENAS A LINHA
	\$id" . $tableUp . " = Uteis::escapeRequest(\$_REQUEST[\"id" . $tableUp . "\"]);	
	\$ordem = \$_REQUEST[\"ordem\"];
		
	\$arrayRetorno[\"updateTr\"] = \$" . $tableUp . " -> tabela" . $tableUp . "_html(\" WHERE " . $tableAs . ".id = \$id" . $tableUp . "\", \$caminho, \$atualizar, \$ondeAtualizar, \$campos, \$ordem);
	\$arrayRetorno[\"tabela\"] = \$idTabela;
	\$arrayRetorno[\"ordem\"] = \$ordem;
	
	echo json_encode(\$arrayRetorno);
	exit;		
	
}

//FILTROS
" . ($temExcluido ? "\$where = \" WHERE " . $tableAs . ".excluido = 0\";" : "\$where .= \" WHERE 1 \";") . "
" . $carrega3 . "
//echo \$where;
?>

<fieldset>
  <legend>" . $tabelaNome . "</legend>
  
  <div class=\"menu_interno\"> 
  	<img src=\"<?php echo CAM_IMG.\"novo.png\";?>\" title=\"Novo cadastro\" 
		onclick=\"abrirNivelPagina(this, '<?php echo \$caminho.\"abas.php\"?>', " . (isset($_POST["filtro"]) ? "'click', '#btFiltro_" . $table . "'" : "'<?php echo \$atualizar?>', '#centro'") . ")\" /> 
  </div>
  
  <div class=\"lista\">
		<?php //IMPRIMIR TABELA
		Html::set_idTabela(\$idTabela);
		Html::set_colunas(array(" . $carrega2 . "\"\"));
		echo \$" . $tableUp . " -> tabela" . $tableUp . "_html(\$where, \$caminho, \$atualizar, \$ondeAtualizar, \$campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo \$idTabela?>', '" . (isset($_POST["filtro"]) ? "" : "simples") . "');
	</script>
	   	      
</fieldset>
";

$pathname = "../view/" . $table;
if (!file_exists($pathname))
	mkdir($pathname, 0700);

$nomeArquivo = $pathname . "/lista.php";
if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['lista'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
