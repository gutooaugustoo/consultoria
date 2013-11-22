<?php
session_start();
ob_start();
ini_set("register_globals","Off");
mb_internal_encoding("UTF-8");

//CONFIGURA��O DE LOCALE
if (strpos($_SERVER["SERVER_SOFTWARE"], "Win32")) {
	define("LOCALE","ptb");
} else {
	define("LOCALE","pt_BR");
}
setlocale(LC_ALL, LOCALE);

define("VERS�O", "2.0 (EM DESENVOLVIMENTO)");

//PASTAS PADR�O
define("CAMINHO_UP", "/consultoria/upload/");
define("CAMINHO_UP_ROOT", $_SERVER['DOCUMENT_ROOT']."/consultoria/upload/");

define("CAMINHO_IMG", "/consultoria/images/");
define("CAMINHO_CFG", "/consultoria/config/");	

define("CAMINHO_VER_PP", $_SERVER['SERVER_NAME']."/consultoria/proposta/");
define("CAMINHO_VER_PA", $_SERVER['SERVER_NAME']."/consultoria/planoAcao/");

define("MSG_CADNEW", "Cadastro efetuado com sucesso.");
define("MSG_CADATU", "Cadastro atualizado com sucesso.");
define("MSG_CADDEL", "Cadastro deletado com sucesso.");

?>