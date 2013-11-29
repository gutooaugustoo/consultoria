<?php
$tableUp = ucfirst($table);

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
			\$this->" . $campo['nomeComTabela'] . " = \$array[0]['" . $campo['nome'] . "'];";
}

//SETS
$sets = "";
foreach ($campos as $campo) {
	$sets .= "
	function set_" . $campo['nomeComTabela'] . "(\$valor) {
		";

	if ($campo['tipo'] == 'int') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"NULL\";";
	} elseif ($campo['tipo'] == 'double') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarMoeda(\$valor)) : \"0\";";
	} elseif ($campo['tipo'] == 'tinyint') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"0\";";
	} elseif ($campo['tipo'] == 'date') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarData(\$valor)) : \"NULL\";";
	} elseif ($campo['tipo'] == 'datetime') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarDataHora(\$valor)) : \"NULL\";";
	} elseif ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$sets .= "\$this->" . $campo['nomeComTabela'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"NULL\";";
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
		$gets .= "return (\$this->" . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'double') {
		$gets .= "return !\$formatarMoeda ? Uteis::exibirMoeda(\$this->" . $campo['nomeComTabela'] . ") : \"R\$ \".Uteis::formatarMoeda(\$this->" . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'tinyint') {
		$gets .= "return !\$mostrarImagem ? \$this->" . $campo['nomeComTabela'] . " : Uteis::exibirStatus(\$this->" . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'date') {
		$gets .= "if( \$this->" . $campo['nomeComTabela'] . " ) return Uteis::exibirData(\$this->" . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'datetime') {
		$gets .= "if( \$this->" . $campo['nomeComTabela'] . " ) return Uteis::exibirDataHora(\$this->" . $campo['nomeComTabela'] . ");";
	} elseif ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$gets .= "return (\$this->" . $campo['nomeComTabela'] . ");";
	}

	$gets .= "
	}
	";
}

//INSERT
$insert = "\$sql = \"INSERT INTO " . $table . " (";
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
		$x .= "\$this->" . $campo['nomeComTabela'] . ", ";
}
$insert .= substr($x, 0, -2);
$insert .= ")\";";

//UPDATE
$update = "SET ";
$x = "";

foreach ($campos as $campo) {

	if ($campo['relac'] != 'pk')
		$x .= $campo['nome'] . " = \$this->" . $campo['nomeComTabela'] . ", ";
}
$update .= substr($x, 0, -2);

//////////////////////////////////////////////////////////////////////////////////////////////////
$conteudoArquivo = "<?php
class " . $tableUp . "_m extends Database { 
	
	// ATRIBUTOS" . $attr . "
	
	//CONSTRUTOR
	function __construct( \$id" . $tableUp . " = \"\" ) {
		
		parent::__construct();
		
		if( is_numeric(\$id" . $tableUp . ") ){
		
			\$array = \$this->select" . $tableUp . "(\" WHERE id = \".\$this->gravarBD(\$id" . $tableUp . ") );			
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
		\$result = \$this->query(\$sql);
		return mysql_insert_id(\$this->connect);
	}
	
	function delete" . $tableUp . "() {
		if( \$this->id" . $tableUp . " ){
			\$sql = \"UPDATE " . $table . " SET excluido = 1 WHERE id = \".\$this->id" . $tableUp . ";
			//\$sql = \"DELETE FROM " . $table . " WHERE id = \".\$this->id" . $tableUp . ";
			return \$this->query(\$sql);
		}else{
			return false;
		}
	}

	function update" . $tableUp . "() {
		if( \$this->id" . $tableUp . " ){
			\$sql = \"UPDATE " . $table . "
			" . $update . "
			WHERE id = \$this->id" . $tableUp . "\";
			return \$this->query(\$sql);
		}else{
			return false;
		}
	}
	
	function updateCampo" . $tableUp . "(\$campo, \$valor) {		
		if( \$this->id" . $tableUp . " ){
			\$sql = \"UPDATE " . $table . " SET \$campo = \".\$this->gravarBD(\$valor).\" WHERE id = \$this->id" . $tableUp . "\";
			return \$this->query(\$sql);
		}else{
			return false;
		}
	}

	function select" . $tableUp . "(\$where = \"\", \$campos = array(\"*\") ) {	
		\$sql = \"SELECT SQL_CACHE \".implode(\",\", \$campos).\" FROM " . $table . " \".\$where;
		return \$this->executarQuery(\$sql);
	}
		
}
";

$nomeArquivo = "../class/model/" . $tableUp . "_m.class.php";

if (!file_exists($nomeArquivo) || $sobrescrever) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);
	$gerada['model'][] = $table;
} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
