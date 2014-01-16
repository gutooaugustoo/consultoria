<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/padrao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/config.php";

define("NOME_APP", "Portal do ".ucfirst($_SESSION['logado']) );
//define("VERSAO", "1.0");
define("CAM_VIEW", CAM_ROOT."/view_".$_SESSION['logado']."/");

$Login = new Login();

if ( $Login -> verificarLogin() && isset($pgLogin) ) {
	header('Location:'.CAM_ROOT.'/');
} elseif (!($Login -> verificarLogin()) && !isset($pgLogin)) {
	header('Location:'.CAM_ROOT.'/login.php');
}

//Uteis::pr($_SESSION);
