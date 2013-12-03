<?php
include 'config.php';

function separaString($string) {

	$array = str_split($string);
	$srting_final = "";
	$proximoMaiuscula = TRUE;

	foreach ($array as $key => $value) {

		if ($proximoMaiuscula) {
			$value = strtoupper($value);
			$proximoMaiuscula = FALSE;
		}

		if ($value == "_" || $value == "-") {
			$value = " ";
			$proximoMaiuscula = TRUE;
		}

		if (ctype_upper($value)) {
			$value = " $value";
		}

		$srting_final .= $value;
	}

	return trim(str_replace(array(
		"id",
		"ID",
		"Id",
		"iD"
	), "", $srting_final));

}

function gravarArquivo(){
	
}

if ($_POST["table"]) {
	foreach ($_POST["table"] as $table) {

		$colunas = mysql_query("SHOW COLUMNS FROM " . $table);

		$j = 0;
		$campos = array();
		$temExcluido = false;
		$primeiroCampoValido = "";
		$tableAs = strtoupper(substr($table, 0, 1));
		$tableUp = ucfirst($table);
		$tabelaNome = separaString($table);
		
		while ($row = mysql_fetch_array($colunas)) {

			//print_r($row); //exit;
			
			if ($row['Field'] == "excluido")
				$temExcluido = true;
			
			if ($row['Field'] == "inativo")
				$temInativo = true;
						
			if ($row['Field'] != 'dataCadastro' && $row['Field'] != 'excluido') {

				$campos[$j]['nome'] = trim($row['Field']);				
				$campos[$j]['nomeAmigavel'] = separaString($row['Field']);
				$campos[$j]['nomeComTabela'] = $row['Field'] . ucfirst($table);			
				$campos[$j]['default'] = $row['Default'];	
				$campos[$j]['accNulo'] = ($row['Null'] == 'NO') ? 0 : 1;
				$tipo = str_replace(array(
					"(",
					")",
					"0",
					"1",
					"2",
					"3",
					"4",
					"5",
					"6",
					"7",
					"8",
					"9"
				), "", (string)$row['Type']);				
				$campos[$j]['tipo'] = $tipo; 
					
				if ( $tipo == "varchar" )
					$primeiroCampoValido = $row['Field'];

				if ($row['Key'] == 'PRI') {
					$campos[$j]['relac'] = 'pk';
				} elseif ($row['Key'] == 'MUL') {
					$campos[$j]['relac'] = 'fk';

					$tbReference = mysql_query("SELECT REFERENCED_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$table' AND COLUMN_NAME = '" . $row['Field'] . "'");
					$tbReference = mysql_fetch_array($tbReference);
					//print_r($tbReference);exit;
					$campos[$j]['relacTb'] = ucfirst($tbReference['REFERENCED_TABLE_NAME']);

				} else {
					$campos[$j]['relac'] = '';
				}		

				$j++;
			}
		}
		//echo"<pre>";print_r($campos);echo"</pre>";
		$sobrescrever = $_POST["sobrescrever"];

		if (isset($_POST["classm"])) {

			include 'gera_model.php';
		}

		if (isset($_POST["class"])) {

			include 'gera_controller.php';
		}

		if (isset($_POST["filtro"])) {

			include 'gera_filtro.php';
		}
		
		if (isset($_POST["lista"])) {

			include 'gera_lista.php';
		}

		if (isset($_POST["formulario"])) {

			include 'gera_form.php';
		}

		if (isset($_POST["acao"])) {

			include 'gera_acao.php';
		}

	}
	echo "<b>Códigos gerados com sucesso - " . date('d/m/Y H:i:s') . "</b>";

	foreach ($gerada as $key => $value) {
		echo "<li>" . $key . " - " . implode(", ", $value) . "</li>";
	}

} else {
	echo "Nenhuma tabel foi selecionada";

}
