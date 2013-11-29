<?php
session_start();
ob_start();
ini_set("register_globals","Off");
error_reporting(
	//0
	E_ERROR | E_PARSE
	//E_ALL	
);

define("DATABASE_SERVER", "localhost");
define("DATABASE_USER", "root");
define("DATABASE_PASS", "");

function __autoload($class) {
	$caminhoClass = $_SERVER['DOCUMENT_ROOT']."class/".$class.".php";	
	if( file_exists($caminhoClass) ){ 
		require_once $caminhoClass;
		return true; 
		echo "Erro: Classe não encontrada ($class)";
		exit;
	}	
}

$conn= mysql_pconnect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS) or exit( mysql_error() );

?>