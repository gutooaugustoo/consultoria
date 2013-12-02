<?php
$carrega = "";

//
$carrega2 = "";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {

		if ($campo['tipo'] == 'double' || $campo['tipo'] == 'tinyint') {
			$carrega2 .= "
				\$colunas[] = \$this -> get_" . $campo['nomeComTabela'] . "(true);";
		} elseif ($campo['relac'] == "fk") {
			$carrega2 .= "
				\$" . $campo['relacTb'] . " = new " . $campo['relacTb'] . "( \$this -> get_" . $campo['nomeComTabela'] . "() );
				\$colunas[] = \$". $campo['relacTb'] . " -> get_id".$campo['relacTb']."();";
		} else {
			$carrega2 .= "
				\$colunas[] = \$this -> get_" . $campo['nomeComTabela'] . "();";
		}

	}

}

//
$carrega4 = "";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {
		$carrega4 .= "
		\$" . $campo['nome'] . " = (\$post['" . $campo['nome'] . "']);";

		if (!$campo['accNulo'] && $campo['tipo'] != 'tinyint') {
			$carrega4 .= "
			 if( \$" . $campo['nome'] . " == '' ) return array(false, MSG_OBRIGAT.\" " . $campo['nomeAmigavel'] . "\");";
		}
		$carrega4 .= "
		";
	}

}

//
$carrega5 = "
		\$this";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {
		$carrega5 .= "
			 -> set_" . $campo['nomeComTabela'] . "(\$" . $campo['nome'] . ")";
	}
}
$carrega5 .= ";";

$conteudoArquivo = "<?php
class " . $tableUp . " extends " . $tableUp . "_m {
		
	//CONSTRUTOR
	function __construct(\$id" . $tableUp . ") {
		parent::__construct(\$id" . $tableUp . ");	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function select" . $tableUp . "_html(\$nomeId, \$idAtual = \"\", \$where = \"WHERE 1 \") {
		" . ($temExcluido ? "\$where .= \" AND " . $tableAs . ".excluido = 0\";" : "\$where .= \"\";") . "
		\$campos = array(\"id\", \"" . $primeiroCampoValido . " AS legenda\");
		\$array = \$this -> select" . $tableUp . "(\$where, \$campos);
		return Html::select(\$nomeId, \$idAtual, \$array);
	}
	
	function selectMultiple" . $tableUp . "_html(\$nomeId, \$idAtual = array(), \$where = \"WHERE 1 \") {
		" . ($temExcluido ? "\$where .= \" AND " . $tableAs . ".excluido = 0\";" : "\$where .= \"\";") . "
		\$campos = array(\"id\", \"" . $primeiroCampoValido . " AS legenda\");
		\$array = \$this -> select" . $tableUp . "(\$where, \$campos);
		return Html::selectMultiple(\$nomeId, \$idAtual, \$array);
	}
	
	/*function checkBox" . $tableUp . "_html(\$nomeId, \$idAtual = array(), \$where = \"WHERE 1 \") {
		" . ($temExcluido ? "\$where .= \" AND " . $tableAs . ".excluido = 0\";" : "\$where .= \"\";") . "
		\$campos = array(\"id\", \"" . $primeiroCampoValido . " AS legenda\");
		\$array = \$this -> select" . $tableUp . "(\$where, \$campos);
		return Html::selectMultiple(\$nomeId, \$idAtual, \$array);
	}*/
			
	function tabela" . $tableUp . "_html(\$where = \"\", \$caminho = \"\", \$atualizar = \"\", \$ondeAtualizar = \"\", \$campos = array(\"*\"), \$apenasLinha = false){
			
		\$array = \$this -> select" . $tableUp . "(\$where, \$campos);
		
		if( \$array ){
				
			\$cont = 0;				
			\$linha = array();
						
			foreach(\$array as \$iten){
					
				\$colunas = array();
				
				//CARREGAR VALORES
				\$this -> __construct(\$iten['id']); 				
				" . $carrega2 . "
				
				\$ordem = ( \$apenasLinha !== false ) ? \$apenasLinha : \$cont++;								
				\$urlAux = \"?ordem=\".\$ordem.\"&tabela=\".Html::get_idTabela();				
				\$atualizarFinal = \$atualizar.\$urlAux.\"&tr=1&id" . $tableUp . "=\".\$this -> id" . $tableUp . ";
						
				\$editar = \"<img src=\\\"\".CAM_IMG.\"editar.png\\\" title=\\\"Editar registro\\\" 
				onclick=\\\"abrirNivelPagina(this, '\".\$caminho.\"form.php?id" . $tableUp . "=\".\$this -> id" . $tableUp . ".\"', '\$atualizarFinal', '\$ondeAtualizar')\\\" >\";
				
				\$deletar = \"<img src=\\\"\".CAM_IMG.\"excluir.png\\\" title=\\\"Excluir registro\\\" 
				onclick=\\\"deletaRegistro('\".\$caminho.\"acao.php\".\$urlAux.\"', '\".\$this -> id" . $tableUp . ".\"', '\$atualizarFinal', '\$ondeAtualizar')\\\">\";							
					
				if( \$apenasLinha !== false ){
						
					\$colunas[] = implode(ICON_SEPARATOR, array(
						\$editar,
						\$deletar
					));									
					break;
					
				}else{
						
					\$colunas[] = array(
						\$editar,
						\$deletar
					);
					\$linhas[] = \$colunas;
					
				}
								
			}
	
		}		
	
		return ( \$apenasLinha !== false ) ? \$colunas : Html::montarColunas(\$linhas);
		
	}
	
	//AÇÕES
	function cadastrar" . $tableUp . "(\$id" . $tableUp . ", \$post = array()){
		
		//CARREGAR DO POST" . $carrega4 . "		
		//SETAR" . $carrega5 . "
		
		if( \$id" . $tableUp . " ){			
			\$this -> set_id" . $tableUp . "(\$id" . $tableUp . ");			
			return ( \$this -> update" . $tableUp . "() );
		}else{			
			return ( \$this -> insert" . $tableUp . "() );			
		}

	}
		
	function deletar" . $tableUp . "(\$id" . $tableUp . ") {
		\$this -> set_id" . $tableUp . "(\$id" . $tableUp . ");	
		return (	\$this -> delete" . $tableUp . "() );
	}
	
}

";

$nomeArquivo = "../class/controller/" . $tableUp . ".class.php";

if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['controller'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
