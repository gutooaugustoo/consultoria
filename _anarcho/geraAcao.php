<?php
$tableUp = ucfirst($table);

$conteudoArquivo = "<?php
require_once(\$_SERVER['DOCUMENT_ROOT'].\"/consultoria/config/admin.php\");

\$" . $tableUp . " = new " . $tableUp . "();

\$id = \$_REQUEST['id'];

\$arrayRetorno = array();

if( \$_REQUEST['acao'] == \"deletar\" ){

	\$res = \$" . $tableUp . "->deletar(\$id);
	
	if( \$res[0] === true ){
		
		\$arrayRetorno['fecharNivel'] = true;
		
		\$arrayRetorno['tabela'] = \$_REQUEST['tabela'];
		\$arrayRetorno['ordem'] = \$_REQUEST['ordem'];	
		
	}else{
		//
	}
	
}elseif( \$_REQUEST['acao'] == \"cadastrar\" ){
	
	\$res = \$" . $tableUp . "->cadastrar(\$id, \$_POST);

	if( \$res[0] == true ){
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

if( !file_exists($nomeArquivo) || $sobrescrever ) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);

} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
