<?php
session_start();
ob_start();
ini_set("register_globals","Off");
mb_internal_encoding("UTF-8");

//CONFIGURA DE LOCALE
if (strpos($_SERVER["SERVER_SOFTWARE"], "Win32")) {
	define("LOCALE","ptb");
} else {
	define("LOCALE","pt_BR");
}
setlocale(LC_ALL, LOCALE);

define("VERSAO", "1.0 (EM DESENVOLVIMENTO)");

//PASTAS PADR�O
define("CAM_UP", "/consultoria/upload/");
define("CAM_UP_ROOT", $_SERVER['DOCUMENT_ROOT']."/consultoria/upload/");

define("CAM_IMG", "/consultoria/images/");
define("CAM_IMG2", "http://".$_SERVER['SERVER_NAME']."/consultoria/images/");
	define("ICON_SEPARATOR", "<img src=\"" . CAM_IMG . "separator.png\" />");
define("CAM_CFG", "/consultoria/config/");
define("CAM_CLASS", "/consultoria/class/");	
define("CAM_VIEW", "/consultoria/view/");

define("MSG_CADNEW", "Cadastro efetuado com sucesso.");
define("MSG_CADUP", "Cadastro atualizado com sucesso.");
define("MSG_CADDEL", "Cadastro deletado com sucesso.");
define("MSG_OBRIGAT", "Preenchimento obrigat&oacute;rio:");

//AUTOLOAD DE CLASSES
function __autoload($class) {
	
	$caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."/".$class.".class.php";
	if( file_exists($caminhoClass) ){ 
		require_once $caminhoClass;
		return true;
	}
	
	$caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."controller/".$class.".class.php";		
	if( file_exists($caminhoClass) ){ 
		require_once $caminhoClass;
		return true; 
	}
	
	$caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."model/".$class.".class.php";		
	if( file_exists($caminhoClass) ){ 
		require_once $caminhoClass;
		return true; 
	}
	
	echo "Erro: Classe não encontrada ($class)";
	
	exit;
		
}

