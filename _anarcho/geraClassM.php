<?php
$tableUp = ucfirst($table);

$attr = "";
foreach ($campos as $campo) {
	//echo"<pre>";print_r($campo);echo"</pre>";
	$attr .= "
	protected \$" . $campo['nome'];
	if( $campo['default'] != "" ) $attr .= " = ".(is_numeric($campo['default']) ? $campo['default'] : "\"".$campo['default']."\"");
	$attr .= ";";
}

//CONSTRUTOR
$contruct = "";
foreach ($campos as $campo) {
	$contruct .= "
			\$this->" . $campo['nome'] . " = \$array[0]['" . $campo['nome'] . "'];";
}

//SETS
$sets = "";
foreach ($campos as $campo) {
	$sets .= "
	function set_" . $campo['nome'] . "(\$valor) {
		";

	if ($campo['tipo'] == 'int') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"NULL\";";
	} elseif ($campo['tipo'] == 'double') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarMoeda(\$valor)) : \"0\";";
	} elseif ($campo['tipo'] == 'tinyint') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"0\";";
	} elseif ($campo['tipo'] == 'date') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarData(\$valor)) : \"NULL\";";
	} elseif ($campo['tipo'] == 'datetime') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(Uteis::gravarDataHora(\$valor)) : \"NULL\";";
	} elseif ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$sets .= "\$this->" . $campo['nome'] . " = (\$valor) ? \$this->gravarBD(\$valor) : \"NULL\";";
	}

	$sets .= "
	}
	";
}

//GETS
$gets = "";
foreach ($campos as $campo) {

	$gets .= "
	function get_" . $campo['nome'] . "";

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
		$gets .= "return (\$this->" . $campo['nome'] . ");";
	} elseif ($campo['tipo'] == 'double') {
		$gets .= "return !\$formatarMoeda ? Uteis::exibirMoeda(\$this->" . $campo['nome'] . ") : \"R\$ \".Uteis::formatarMoeda(\$this->" . $campo['nome'] . ");";
	} elseif ($campo['tipo'] == 'tinyint') {
		$gets .= "return !\$mostrarImagem ? \$this->" . $campo['nome'] . " : Uteis::exibirStatus(\$this->" . $campo['nome'] . ");";
	} elseif ($campo['tipo'] == 'date') {
		$gets .= "if( \$this->" . $campo['nome'] . " ) return Uteis::exibirData(\$this->" . $campo['nome'] . ");";
	} elseif ($campo['tipo'] == 'datetime') {
		$gets .= "if( \$this->" . $campo['nome'] . " ) return Uteis::exibirDataHora(\$this->" . $campo['nome'] . ");";
	} elseif ($campo['tipo'] == 'text' || $campo['tipo'] == 'varchar') {
		$gets .= "return (\$this->" . $campo['nome'] . ");";
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
		$x .= "\$this->" . $campo['nome'] . ", ";
}
$insert .= substr($x, 0, -2);
$insert .= ")\";";

//UPDATE
$update = "SET ";
$x = "";
foreach ($campos as $campo) {
	if ($campo['relac'] != 'pk')
		$x .= $campo['nome'] . " = \$this->" . $campo['nome'] . ", ";
}
$update .= substr($x, 0, -2);

//////////////////////////////////////////////////////////////////////////////////////////////////
$conteudoArquivo = "<?php
class " . $tableUp . "_m extends Database { 
	
	// ATRIBUTOS" . $attr . "
	
	//CONSTRUTOR
	function __construct( \$id = \"\" ) {
		
		parent::__construct();
		
		if( \$id != \"\" ){
		
			\$array = \$this->select(\" WHERE id = \".\$this->gravarBD(\$id) );			
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
			
	//INTERAÇÃO COM O BANCO
		
	function insert() {
		" . $insert . "
		\$result = \$this->query(\$sql);
		return mysql_insert_id(\$this->connect);
	}
	
	function delete() {
		if( \$this->id ){
			\$sql = \"UPDATE " . $table . " SET excluido = 1 WHERE id = \".\$this->id;
			\$this->query(\$sql);
		}
	}

	function update() {
		if( \$this->id ){
			\$sql = \"UPDATE " . $table . "
			" . $update . "
			WHERE id = \$this->id\";
			\$this->query(\$sql);
		}
	}
	
	function updateCampo(\$campo, \$valor) {		
		if( \$this->id ){
			\$sql = \"UPDATE " . $table . " SET \$campo = \".\$this->gravarBD(\$valor).\" WHERE id = \$this->id\";
			\$this->query(\$sql);
		}
	}

	function select(\$where = \"\", \$campos = array(\"*\") ) {	
		\$sql = \"SELECT SQL_CACHE \".implode(\",\", \$campos).\" FROM " . $table . " \".\$where;
		return \$this->executarQuery(\$sql);
	}
		
}
";

$nomeArquivo = "../class/model/" . $tableUp . "_m.class.php";

if( !file_exists($nomeArquivo) || $sobrescrever ) {

	$arquivo = fopen($nomeArquivo, 'w');
	fwrite($arquivo, $conteudoArquivo);
	fclose($arquivo);

} else {
	echo "Arquivo já esxiste ($nomeArquivo).<br />";
	//exit;
}
