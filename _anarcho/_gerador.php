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

	return $srting_final;

}

if ($_POST["table"]) {
	foreach ($_POST["table"] as $table) {

		$colunas = mysql_query("SHOW COLUMNS FROM " . $table);

		$j = 0;
		$campos = array();

		while ($row = mysql_fetch_array($colunas)) {
			//print_r($row);exit;
			if ($row['Field'] != 'dataCadastro' && $row['Field'] != 'excluido') {
				$campos[$j]['nome'] = $row['Field'];
				$campos[$j]['nome2'] = separaString($row['Field']);
				$campos[$j]['tipo'] = str_replace(array(
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
				$campos[$j]['accNulo'] = ($row['Null'] == 'NO') ? 0 : 1;
				$campos[$j]['relac'] = ($row['Key'] == 'PRI') ? 'pk' : ($row['Key'] == 'MUL' ? 'fk' : '');
				$campos[$j]['default'] = $row['Default'];

				$j++;
			}
		}
		//echo"<pre>";print_r($campos);echo"</pre>";

		if (isset($_POST["classm"])) {

			include 'gera_model.php';
		}

		if (isset($_POST["class"])) {

			include 'gera_controller.php';
		}

		if (isset($_POST["lista"])) {

			include 'gera_lista.php';
		}

		if (isset($_POST["form"])) {

			include 'gera_form.php';
		}

		if (isset($_POST["acao"])) {

			include 'gera_acao.php';
		}

	}
	echo "<b>Códigos gerados com sucesso - " . date('d/m/Y H:i:s')."</b>";
	
	foreach ($gerada as $key => $value) {		
		echo "<li>".$key." - ".implode(", ", $value)."</li>";
	}
	
} else {
	echo "Nenhuma tabel foi selecionada";

}
