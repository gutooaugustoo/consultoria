<?php
$attr = "";
foreach ($campos as $campo) {
	//echo"<pre>";print_r($campo);echo"</pre>";
	$attr .= "
	protected \$" . $campo['nomeComTabela'];
	if ($campo['default'] != "")
		$attr .= " = " . (is_numeric($campo['default']) ? $campo['default'] : "\"" . $campo['default'] . "\"");
	$attr .= ";";
}

//CONSTRUTOR
$contruct = "";
foreach ($campos as $campo) {
	$contruct .= "
			\$this -> " . $campo['nomeComTabela'] . " = \$array[0]['" . $campo['nome'] . "'];";
}

//SETS
$sets = "";
foreach ($campos as $campo) {
	$sets .= "
	function set_" . $campo['nomeComTabela'] . "(\$valor) {
		";

	if ($campo['tipo'] == 'int') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(\$valor) : \"NULL\";";
	} elseif ($campo['tipo'] == 'double') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(Uteis::gravarMoeda(\$valor)) : \"0\";";
	} elseif ($campo['tipo'] == 'tinyint') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(\$valor) : \"0\";";
	} elseif ($campo['tipo'] == 'date') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(Uteis::gravarData(\$valor)) : \"NULL\";";
	} elseif ($campo['tipo'] == 'datetime') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(Uteis::gravarDataHora(\$valor)) : \"NULL\";";
	} else {//if ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$sets .= "\$this -> " . $campo['nomeComTabela'] . " = (\$valor) ? \$this -> gravarBD(\$valor) : \"NULL\";";
	}

	$sets .= "
		return \$this;
	}
	";
}

//GETS
$gets = "";
foreach ($campos as $campo) {

	$gets .= "
	function get_" . $campo['nomeComTabela'] . "";

	if ($campo['tipo'] == 'double') {
		$gets .= "(\$formatarMoeda = false) {
		";
	} elseif ($campo['tipo'] == 'tinyint') {
		$gets .= "(\$mostrarImagem = false) {
		";
	} else {
		$gets .= "() {
		";
	}

	if ($campo['tipo'] == 'int') {
		$gets .= "return (\$this -> " . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'double') {
		$gets .= "return !\$formatarMoeda ? Uteis::exibirMoeda(\$this -> " . $campo['nomeComTabela'] . ") : \"R\$ \".Uteis::formatarMoeda(\$this -> " . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'tinyint') {
		$gets .= "return !\$mostrarImagem ? \$this -> " . $campo['nomeComTabela'] . " : Uteis::exibirStatus(\$this -> " . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'date') {
		$gets .= "if( \$this -> " . $campo['nomeComTabela'] . " ) return Uteis::exibirData(\$this -> " . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'datetime') {
		$gets .= "if( \$this -> " . $campo['nomeComTabela'] . " ) return Uteis::exibirDataHora(\$this -> " . $campo['nomeComTabela'] . ");";
	} else {//if ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$gets .= "return (\$this -> " . $campo['nomeComTabela'] . ");";
	}

	$gets .= "
	}
	";
}

//INSERT
$insert = "\$sql = \"INSERT INTO " . $table . " 
		(";
$x = "";
foreach ($campos as $campo) {
	if ($campo['relac'] != 'pk')
		$x .= $campo['nome'] . ", ";
}
$insert .= substr($x, 0, -2);
$insert .= ") 
		VALUES (";
$x = "";
foreach ($campos as $campo) {
	if ($campo['relac'] != 'pk')
		$x .= "	
			\" . \$this -> " . $campo['nomeComTabela'] . " . \", ";
}
$insert .= substr($x, 0, -2);
$insert .= "
		)\";";

//DELETE
$modelDelete = "";
if ($temExcluido) {
	$modelDelete .= "return \$this -> updateCampo" . $tableUp . "(array(\"excluido\" => \"1\"), MSG_CADDEL);";
} else {
	$modelDelete .= "
		if( \$this -> id" . $tableUp . " ){
			\$sql = \"DELETE FROM " . $table . " WHERE id = \".\$this -> id" . $tableUp . ";			
			return \$this -> query(\$sql, MSG_CADDEL);
		}else{
			return array(false, MSG_ERR);
		}
	";
}

//UPDATE
$update = "	array(";
$update2 = "";

foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk')
		$update2 .= "		
					\"" . $campo['nome'] . "\" => \$this -> " . $campo['nome'] . $tableUp . ", ";

}
$update .= substr($update2, 0, -2) . "				
				)";

//\$sql =  WHERE id = \$this -> id" . $tableUp . "\";

//////////////////////////////////////////////////////////////////////////////////////////////////
$conteudoArquivo = "<?php
class " . $tableUp . "_m extends Database { 
	
	// ATRIBUTOS" . $attr . "
	
	//CONSTRUTOR
	function __construct( \$id" . $tableUp . " = \"\" ) {
		
		parent::__construct();
		
		if( is_numeric(\$id" . $tableUp . ") ){
		
			\$array = \$this -> select" . $tableUp . "(\" WHERE " . $tableAs . ".id = \".\$this -> gravarBD(\$id" . $tableUp . ") );			
			" . $contruct . "
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	" . $sets . "	
	//GETS
	" . $gets . "			
	//MANUSEANDO O BANCO
		
	function insert" . $tableUp . "() {
		" . $insert . "
		if( \$this -> query(\$sql) ){
			return array(mysql_insert_id(\$this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function delete" . $tableUp . "() {
		" . $modelDelete . "
	}

	function update" . $tableUp . "() {
		if( \$this -> id" . $tableUp . " ){
				
			return \$this -> updateCampo" . $tableUp . "(
			" . $update . "	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampo" . $tableUp . "(\$sets = array(), \$msg = MSG_CADUP) {		
		if( \$this -> id" . $tableUp . " && is_array(\$sets) ){
			\$sql = \"UPDATE " . $table . " SET \".Uteis::montarUpdate(\$sets).\" WHERE id = \".\$this -> id" . $tableUp . ";							
			return \$this -> query(\$sql, \$msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function select" . $tableUp . "(\$where = \"\", \$campos = array(\"" . $tableAs . ".*\") ) {	
		\$sql = \"SELECT SQL_CACHE \".implode(\",\", \$campos).\" FROM " . $table . " AS " . $tableAs . " \".\$where;
		return \$this -> executarQuery(\$sql);
	}
		
}
";

$nomeFile = $tableUp . "_m.class";
gravarArquivo("class/model", $table, $nomeFile, $conteudoArquivo);
