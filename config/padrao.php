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

//PASTAS PADRAO
define("CAM_ROOT", "/consultoria");
define("CAM_ROOT_COMPLETO", "http://".$_SERVER['SERVER_NAME'].CAM_ROOT."/");

	define("CAM_UP", CAM_ROOT."/upload/");
	define("CAM_UP_ROOT", $_SERVER['DOCUMENT_ROOT'].CAM_ROOT."/upload/");
	
	define("CAM_IMG", CAM_ROOT."/images/");
	define("CAM_IMG2", "http://".$_SERVER['SERVER_NAME'].CAM_ROOT."/images/");
		define("ICON_SEPARATOR", "<img src=\"" . CAM_IMG . "separator.png\" />");
		
	define("CAM_CFG", CAM_ROOT."/config/");
	define("CAM_CLASS", CAM_ROOT."/class/");	
	
	//VIEWS ESTATICAS
	define("CAM_VIEW_A", CAM_ROOT."/view_avaliador/");	
	define("CAM_VIEW_C", CAM_ROOT."/view_candidato/");	
	define("CAM_VIEW_F", CAM_ROOT."/view_funcionario/");	
	define("CAM_VIEW_G", CAM_ROOT."/view_gestor/");	
	
define("MSG_CADNEW", "Cadastro efetuado com sucesso.");
define("MSG_CADUP", "Cadastro atualizado com sucesso.");
define("MSG_CADDEL", "Cadastro deletado com sucesso.");
define("MSG_OBRIGAT", "Preenchimento obrigat&oacute;rio:");
define("MSG_ERR", "Não foi possível completar a a&ccedil;&atilde;o");

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

