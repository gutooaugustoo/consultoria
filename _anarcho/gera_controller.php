<?php
$tableUp = ucfirst($table);

$carrega = "";
foreach ($campos as $campo) {
	$carrega .= "
				\$this->" . $campo['nome'] . " = \$iten['" . $campo['nome'] . "'];";
}

//
$carrega2 = "";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {

		if ($campo['tipo'] == 'double' || $campo['tipo'] == 'tinyint') {
			$carrega2 .= "
					\$linha[] = \$this->get_" . $campo['nome'] . "(true);";
		} else {
			$carrega2 .= "
					\$linha[] = \$this->get_" . $campo['nome'] . "();";
		}

	}

}

//
$carrega3 = "";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {

		if ($campo['tipo'] == 'double' || $campo['tipo'] == 'tinyint') {
			$carrega3 .= "
					\$html .= \"<td>\".\$this->get_" . $campo['nome'] . "(true).\"</td>\";";
		} else {
			$carrega3 .= "
					\$html .= \"<td>\".\$this->get_" . $campo['nome'] . "().\"</td>\";";
		}

	}

}

//
$carrega4 = "";
foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk') {
		$carrega4 .= "
		\$" . $campo['nome'] . " = (\$post['" . $campo['nome'] . "']);";

		if (!$campo['accNulo'] && $campo['tipo'] != 'tinyint' ) {
			$carrega4 .= "
		if( \$" . $campo['nome'] . " == '' ) return array(false, MSG_OBRIGAT.\" " . $campo['nome2'] . "\");";
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
			->set_" . $campo['nome'] . "(\$" . $campo['nome'] . ")";
	}
}
$carrega5 .= ";";

$conteudoArquivo = "<?php
class " . $tableUp . " extends " . $tableUp . "_m {
		
	//CONSTRUTOR
	function __construct(\$id) {
		parent::__construct(\$id);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function select_html(\$nomeId, \$idAtual = \"\", \$where = \"WHERE 1 \") {
		\$where .= \" AND excluido = 0\";
		\$campos = array(\"id AS id\", \"primeiroCampo AS legenda\");
		\$array = \$this->select(\$where, \$campos);
		return Html::select(\$nomeId, \$idAtual, \$array);
	}
	
	/*function selectMultiple_html(\$nomeId, \$idAtual = array(), \$where = \"WHERE 1 \") {
		\$where .= \" AND excluido = 0\";
		\$campos = array(\"id AS id\", \"primeiroCampo AS legenda\");
		\$array = \$this->select(\$where, \$campos);
		return Html::selectMultiple(\$nomeId, \$idAtual, \$array);
	}*/
	
	/*function checkBox_html(\$nomeId, \$idAtual = array(), \$where = \"WHERE 1 \") {
		\$where .= \" AND excluido = 0\";
		\$campos = array(\"id AS id\", \"primeiroCampo AS legenda\");
		\$array = \$this->select(\$where, \$campos);
		return Html::selectMultiple(\$nomeId, \$idAtual, \$array);
	}*/
			
	function tabela_html(\$where = \"\", \$caminho = \"\", \$atualizar = \"\", \$ondeAtualizar = \"\", \$campos = array(\"*\"), \$apenasLinha = false){
		
		\$html = \"\";
		\$cont = 0;
			
		\$array = \$this->select(\$where, \$campos);
		
		if( \$array ){
			
			\$html .= \"<tbody>\";
						
			foreach(\$array as \$iten){				
				" . $carrega . "
				
				\$ordem = ( \$apenasLinha !== false ) ? \$apenasLinha : \$cont++;				
				
				\$urlAux = \"?ordem=\".\$ordem.\"&tabela=\".Html::get_idTabela();
				
				\$atualizarFinal = \$atualizar.\$urlAux.\"&tr=1&id=\".\$this->id;
						
				\$editar = \"<img src=\\\"\".CAM_IMG.\"editar.png\\\" title=\\\"Editar registro\\\" onclick=\\\"abrirNivelPagina(this, '\".\$caminho.\"form.php?id=\".\$this->id.\"', '\$atualizarFinal', '\$ondeAtualizar')\\\" >\";
				
				\$deletar = \"<img src=\\\"\".CAM_IMG.\"excluir.png\\\" title=\\\"Excluir registro\\\" onclick=\\\"deletaRegistro('\".\$caminho.\"acao.php\".\$urlAux.\"', '\".\$this->id.\"', '\$atualizarFinal', '\$ondeAtualizar')\\\">\";
								
				if( \$apenasLinha !== false ){

					\$linha = array();
					" . $carrega2 . "
					
					\$linha[] = \$editar;
					\$linha[] = \$deletar;
										
					break;
					
				}else{

					\$html .= \"<tr>\";
					" . $carrega3 . "
					
					\$html .= \"<td align=\\\"center\\\" >\$editar</td>\";					
					\$html .= \"<td align=\\\"center\\\" >\$deletar</td>\";
						
					
					\$html .= \"</tr>\";
					
				}
								
			}
			
			\$html .= \"</tbody>\";
			
		}		
	
		return ( \$apenasLinha !== false ) ? \$linha : Html::montarColunas(\$html, 2);
		
	}
	
	//AÇÕES
	function cadastrar(\$id, \$post = array()){
		
		//CARREGAR DO POST" . $carrega4 . "		
		//SETAR" . $carrega5 . "
		
		if( \$id ){			
			\$this->set_id(\$id);			
			return array(\$this->update(), MSG_CADUP);
		}else{			
			return array(\$this->insert(), MSG_CADNEW);			
		}

	}
		
	function deletar(\$id) {
		\$this->set_id(\$id);	
		return array(	\$this->delete(), MSG_CADDEL);
	}
	
}

";

$nomeArquivo = "../class/controller/" . $tableUp . ".class.php";

if( !file_exists($nomeArquivo) || $sobrescrever ) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['controller'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
