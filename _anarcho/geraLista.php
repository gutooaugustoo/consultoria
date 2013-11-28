<?php
$tableUp = ucfirst($table);
$tabelaNome = separaString($table);

$carrega = "";
foreach ($campos as $campo) {
	$carrega .= "\"" . $campo['nome'] . "\", ";
}

$carrega2 = "";
foreach ($campos as $campo) {
	if ($campo['relac'] != 'pk')
		$carrega2 .= "\"" . $campo['nome2'] . "\", ";
}

$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$id = \$_REQUEST[\"id\"];

\$" . $tableUp . " = new " . $tableUp . "();

\$idTabela = \"tb_" . $table . "\";
\$campos = array(" . $carrega . ");

\$caminho = CAM_VIEW.\"" . $table . "/\";
\$atualizar = CAM_VIEW.\"" . $table . "/lista.php\";
\$ondeAtualizar = \"tr\";	

Html::set_idTabela(\$idTabela);

if( \$_REQUEST[\"tr\"] == \"1\" ){
	
	\$arrayRetorno = array();
	
	\$ordem = \$_REQUEST[\"ordem\"];
		
	\$arrayRetorno[\"updateTr\"] = \$" . $tableUp . "->tabela_html(\" WHERE id = \$id\", \$caminho, \$atualizar, \$ondeAtualizar, \$campos, \$ordem);
	\$arrayRetorno[\"tabela\"] = \$idTabela;
	\$arrayRetorno[\"ordem\"] = \$ordem;
	
	echo json_encode(\$arrayRetorno);
	exit;		
	
}

\$colunas = array(" . $carrega2 . ");

\$where = \" WHERE excluido = 0\";

Html::set_colunas(\$colunas);
\$corpoTabela = \$" . $tableUp . "->tabela_html(\$where, \$caminho, \$atualizar, \$ondeAtualizar, \$campos);
?>

<fieldset>
  <legend>" . $tabelaNome . "</legend>
  <div class=\"menu_interno\"> 
  	<img src=\"<?php echo CAM_IMG.\"novo.png\";?>\" title=\"Novo cadastro\" 
	onclick=\"abrirNivelPagina(this, '<?php echo \$caminho.\"form.php\"?>', '<?php echo \$atualizar?>', '#centro')\" /> 
  </div>
  <div class=\"lista\"> 
  	<?php echo \$corpoTabela?>      
  </div>
</fieldset>
<script>
tabelaDataTable('<?php echo \$idTabela?>', '');
</script> 
";

$pathname = "../view/" . $table;
if (!file_exists($pathname))
	mkdir($pathname, 0700);
$nomeArquivo = $pathname . "/lista.php";

if( !file_exists($nomeArquivo) || $sobrescrever ) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);

} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
