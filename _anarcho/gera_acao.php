<?php
$tableUp = ucfirst($table);

$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$" . $tableUp . " = new " . $tableUp . "();

\$arrayRetorno = array();

if( \$_REQUEST['acao'] == \"deletar\" ){
		
	\$id" . $tableUp . " = \$_REQUEST['id'];
	
	\$res = \$" . $tableUp . "->deletar" . $tableUp . "(\$id" . $tableUp . ");
	
	if( \$res[0] === true ){
		
		\$arrayRetorno['fecharNivel'] = true;
		
		\$arrayRetorno['tabela'] = \$_REQUEST['tabela'];
		\$arrayRetorno['ordem'] = \$_REQUEST['ordem'];	
		
	}else{
		//
	}
	
}elseif( \$_REQUEST['acao'] == \"cadastrar\" ){
		
	\$id" . $tableUp . " = \$_REQUEST['id" . $tableUp . "'];
	
	\$res = \$" . $tableUp . "->cadastrar" . $tableUp . "(\$id" . $tableUp . ", \$_POST);

	if( \$res[0] != false){
		\$arrayRetorno['fecharNivel'] = true;			
	}else{
		//
	}
	
}

\$arrayRetorno['mensagem'] = \$res[1];

echo json_encode(\$arrayRetorno);

";

$pathname = "../view/" . $table;
if (!file_exists($pathname))
	mkdir($pathname, 0700);
$nomeArquivo = $pathname . "/acao.php";

if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['acao'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
